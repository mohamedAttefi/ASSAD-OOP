<?php
require_once 'utilisateur.php';

class guide extends utilisateur
{
    private $statut_approbation;
    public function __construct($nom, $email, $motpasse_hash, $role, $statut_approbation)
    {
        utilisateur::__construct($nom, $email, $motpasse_hash, $role);
        $this->role = "guide";
        $this->statut_approbation = $statut_approbation;
    }
    public function ajouterVisite($conn, $titre, $dateheure, $langue, $capacite_max, $statut, $duree, $prix, $id)
    {
        $sql = "INSERT INTO visitesguidees 
        (titre, dateheure, langue, capacite_max, statutVisite, duree, prix, id_guide)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);


        echo $id;


        $stmt->execute(

            [
                $titre,
                $dateheure,
                $langue,
                $capacite_max,
                $statut,
                $duree,
                $prix,
                $id
            ]
        );

        echo $sql;

        // if ($stmt->execute()) {
        //     echo "Animal ajouté avec succès 🐾";
        // }
    }

    public function seDeconnecter() {}

    public function ajouterEtapeVisite($id_visite) {}

    public function modifierVisite($conn, $titre, $dateheure, $langue, $capacite_max, $statut, $duree, $prix, $id_visite)
    {
        $sql = "UPDATE visitesguidees SET
        titre = ?,
        dateheure = ?,
        langue = ?,
        capacite_max = ?,
        statutVisite = ?,
        duree = ?,
        prix = ?
        WHERE id = ?";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }


        $stmt->execute(
            [
                $titre,
                $dateheure,
                $langue,
                $capacite_max,
                $statut,
                $duree,
                $prix,
                $id_visite
            ]
        );

        $stmt->close();
    }

    public function annuleeVisite($id_visite, $conn)
    {
        $sql = $conn->prepare("delete from visitesguidees where id = '$id_visite'")->execute();
    }

    public static function approuveeGuide($conn, $id)
    {
        return $conn->prepare("update utilisateurs set statut = 'approuvee' where id = $id and statut = 'desapprouvee'")->execute();
    }
    public function desapprouveeGuide($conn, $id)
    {
        return $conn->prepare("update utilisateurs set statut = 'desapprouvee' where id = $id and statut = 'approuvee'")->execute();
    }


    public function getNom()
    {
        return $this->nom;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getMotpasse()
    {
        return $this->motpasse_hash;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getStatut()
    {
        return $this->statut_approbation;
    }
    public function setStatut($newStatut)
    {
        $this->statut_approbation = $newStatut;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($newId)
    {
        $this->id = $newId;
    }
}
