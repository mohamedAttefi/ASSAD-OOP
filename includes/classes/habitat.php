<?php
class habitat
{
    private $id;
    private $nom;
    private $typeclimat;
    private $description;
    private $zonezoo;
    public function __construct($nom, $typeclimat, $description, $zonezoo)
    {
        $this->id = null;
        $this->nom = $nom;
        $this->typeclimat = $typeclimat;
        $this->description = $description;
        $this->zonezoo = $zonezoo;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function getTypeclimat()
    {
        return $this->typeclimat;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getZonezoo()
    {
        return $this->zonezoo;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($newId)
    {
        $this->id = $newId;
    }


    public function creerHabitat($conn)
    {
        $sql = "INSERT INTO habitats 
        (nom, typeclimat, description, zonezoo)
        VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $success = $stmt->execute(
            [
                $this->nom,
                $this->typeclimat,
                $this->zonezoo,
                $this->description
            ]
        );

        $this->setId($conn->lastInsertId());

        return $success;

        // echo $sql;
    }
    public function modifierHabitat($conn, $id)
    {
        if (!empty($this->nom)) {

            $modifier = "UPDATE habitats SET nom = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$this->nom, $id]);
        }

        if (!empty($this->typeclimat)) {

            $modifier = "UPDATE habitats SET typeclimat = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$this->typeclimat, $id]);
        }

        if (!empty($this->zonezoo)) {

            $modifier = "UPDATE habitats SET zonezoo = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$this->zonezoo, $id]);
        }

        if (!empty($this->description)) {

            $modifier = "UPDATE habitats SET description = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$this->description, $id]);
        }
    }
    public function supprimerHabitat($id_habitat) {}


    public function getAll($conn)
    {
        $sql = 'SELECT h.*, COUNT(a.id) as nb_animaux 
    FROM habitats h 
    LEFT JOIN animaux a ON h.id = a.id_habitat 
    GROUP BY h.id 
    ORDER BY h.nom ASC';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchall();
    }
}
