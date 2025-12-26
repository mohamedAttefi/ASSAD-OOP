<?php

class animaux
{
    private $id;
    private $nom;
    private $espece;
    private $alimentation;
    private $paysorigine;
    private $image;
    private $id_habitat;
    private $description;
    public function __construct($nom, $espece, $alimentation, $paysorigine, $image, $id_habitat, $description)
    {
        $this->id = null;
        $this->nom = $nom;
        $this->espece = $espece;
        $this->alimentation = $alimentation;
        $this->paysorigine = $paysorigine;
        $this->image = $image;
        $this->id_habitat = $id_habitat;
        $this->description = $description;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function getEspece()
    {
        return $this->espece;
    }
    public function getAlimentation()
    {
        return $this->alimentation;
    }
    public function getPaysorigine()
    {
        return $this->paysorigine;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($newId)
    {
        $this->id = $newId;
    }


    public function creerAnimal($conn)
    {
        $sql = "INSERT INTO animaux 
        (nom, espece, alimentation, image, paysorigine, descriptioncourte, id_habitat)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $success = $stmt->execute(
            [
                $this->nom,
                $this->espece,
                $this->alimentation,
                $this->image,
                $this->paysorigine,
                $this->description,
                $this->id_habitat
            ]
        );

        $this->setId($conn->lastInsertId());

        return $success;
    }
    public function modifierAnimal($conn, $id)
    {
        if (!empty($this->nom)) {

            $modifier = "UPDATE animaux SET nom = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$this->nom, $id]);
        } elseif (!empty($this->espece)) {

            $modifier = "UPDATE animaux SET espece = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$this->espece, $id]);
        } elseif (!empty($this->alimentation)) {

            $modifier = "UPDATE animaux SET alimentation = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$this->alimentation, $id]);
        } elseif (!empty($this->image)) {

            $modifier = "UPDATE animaux SET image = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$this->image, $id]);
        } elseif (!empty($this->id_habitat)) {

            $modifier = "UPDATE animaux SET id_habitat = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$this->id_habitat, $id]);
        } elseif (!empty($this->descriptioncourte)) {

            $modifier = "UPDATE animaux SET descriptioncourte = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$this->description, $id]);
        } elseif (!empty($this->paysorigine)) {

            $modifier = "UPDATE animaux SET paysorigine = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$this->paysorigine, $id]);
        }
    }
    public function supprimerAnimal($conn, $id)
    {
        $sql = "delete from animaux where id = $id;";
        $res = $conn->prepare($sql);
        $success = $res->execute();
        return $success;
    }

    public function getTotal($conn)
    {
        $stmt_animaux = $conn->prepare("SELECT COUNT(*) as total FROM animaux");
        $stmt_animaux->execute();
        return $stmt_animaux->fetch()['total'];
    }
    public function getAll($conn)
    {
        $stmt_animaux = $conn->prepare("SELECT a.*, h.nom as habitat_nom 
    FROM animaux a 
    LEFT JOIN habitats h ON a.id_habitat = h.id 
    ORDER BY a.nom ASC");
        $stmt_animaux->execute();
        return $stmt_animaux->fetchall();
    }

    public function getOne($conn, $id)
    {
        $sqlFiche = "SELECT animaux.*, habitats.nom as habitat_nom FROM animaux 
            LEFT JOIN habitats ON animaux.id_habitat = habitats.id 
            WHERE animaux.id = ?";
        $stmtFiche = $conn->prepare($sqlFiche);
        $stmtFiche->execute([$id]);

        return $stmtFiche->fetch();
    }
}
