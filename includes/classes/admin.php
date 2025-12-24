<?php
include 'utilisateur.php';

class admin extends utilisateur
{
    public function __construct($nom, $email, $motpasse_hash)
    {
        parent::__construct($nom, $email, $motpasse_hash, "active", "admin");
    }
    public function creerHabitat($conn,  $nom, $typeclimat, $zonezoo, $description)
    {
        $sql = "INSERT INTO habitats 
        (nom, typeclimat, description, zonezoo)
        VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->execute(
            [
                $nom,
                $typeclimat,
                $zonezoo,
                $description
            ]
        );

        // echo $sql;
    }
    public function seDeconnecter() {}
    public function modifierHabitat($conn, $id, $nom, $typeclimat, $zonezoo, $description,)
    {
        if (!empty($nom)) {

            $modifier = "UPDATE habitats SET nom = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$nom, $id]);
        }

        if (!empty($typeclimat)) {

            $modifier = "UPDATE habitats SET typeclimat = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$typeclimat, $id]);
        }

        if (!empty($zonezoo)) {

            $modifier = "UPDATE habitats SET zonezoo = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$zonezoo, $id]);
        }

        if (!empty($description)) {

            $modifier = "UPDATE habitats SET description = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$description, $id]);
        }
    }
    public function supprimerHabitat($id_habitat) {}
    public function creerAnimal($conn, $nom, $espece, $alimentation, $image, $paysorigine, $descriptioncourte, $id_habitat)
    {
        $sql = "INSERT INTO animaux 
        (nom, espece, alimentation, image, paysorigine, descriptioncourte, id_habitat)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->execute(
            [
                $nom,
                $espece,
                $alimentation,
                $image,
                $paysorigine,
                $descriptioncourte,
                $id_habitat
            ]
        );
    }
    public function modifierAnimal($conn, $id, $nom, $espece, $alimentation, $image, $id_habitat, $descriptioncourte, $paysorigine)
    {
        if (!empty($nom)) {

            $modifier = "UPDATE animaux SET nom = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$nom, $id]);
        }

        if (!empty($espece)) {

            $modifier = "UPDATE animaux SET espece = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$espece, $id]);
        }

        if (!empty($alimentation)) {

            $modifier = "UPDATE animaux SET alimentation = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$alimentation, $id]);
        }

        if (!empty($image)) {

            $modifier = "UPDATE animaux SET image = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$image, $id]);
        }

        if (!empty($id_habitat)) {

            $modifier = "UPDATE animaux SET id_habitat = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$id_habitat, $id]);
        }

        if (!empty($descriptioncourte)) {

            $modifier = "UPDATE animaux SET descriptioncourte = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$descriptioncourte, $id]);
        }

        if (!empty($paysorigine)) {

            $modifier = "UPDATE animaux SET paysorigine = ? WHERE id = ?";
            $stmtMod = $conn->prepare($modifier);
            $stmtMod->execute([$paysorigine, $id]);
        }
    }
    public function supprimerAnimal($conn, $id)
    {
        $sql = "delete from animaux where id = $id;";
        echo $sql;
        $res = $conn->prepare();
        $res->execute();
    }
    public function activerUtilisateurs($id_user) {}
    public function desactiverUtilisateurs($id_user) {}
    public function approuveeGuide($conn, $id)
    {
        $update = $conn->prepare("update utilisateurs set statut = 'approuvee' where id = $id and statut = 'desapprouvee'")->execute();
    }
    public function desapprouveeGuide($conn, $id)
    {
        $update = $conn->prepare("update utilisateurs set statut = 'desapprouvee' where id = $id and statut = 'approuvee'")->execute();
    }
    public function supprimerUtilisateur($conn, $id) {
        $sql = $conn->prepare("delete from utilisateurs where id = $id")->execute();
    }
}
