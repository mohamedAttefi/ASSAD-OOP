<?php
include 'utilisateur.php';

class guide extends utilisateur
{
    public function __construct($nom, $email, $motpasse_hash)
    {
        utilisateur::__construct($nom, $email, $motpasse_hash, "desapprouvee", 'guide');
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
}
