<?php
include '../includes/db.php';
include '../includes/classes/admin.php';

$admin = new admin("", "", "");

if (isset($_POST['ajouterAnimal'])) {
    $nom = $_POST['nom'];
    $espece = $_POST['espece'];
    $alimentation = $_POST['alimentation'];
    $image = $_POST['image'];
    $paysorigine = $_POST['paysorigine'];
    $descriptioncourte = $_POST['descriptioncourte'];
    $id_habitat = $_POST['id_habitat'];

    $admin->creerAnimal(
        $conn,
        $nom,
        $espece,
        $alimentation,
        $image,
        $paysorigine,
        $descriptioncourte,
        $id_habitat
    );

    header('location: ../gestion_animaux.php');
    exit;
}


if (isset($_POST['modifierAnimal'])) {

    $id = (int) $_POST['modifierAnimal'];
    $nom = $_POST['nom'];
    $espece = $_POST['espece'];
    $alimentation = $_POST['alimentation'];
    $image = $_POST['image'];
    $id_habitat = (int) $_POST['id_habitat'];
    $descriptioncourte = $_POST['descriptioncourte'];
    $paysorigine = $_POST['paysorigine'];

    $admin->modifierAnimal($conn, $id, $nom, $espece, $alimentation, $image, $id_habitat, $descriptioncourte, $paysorigine);
    
    header('location: ../gestion_animaux.php');
    exit;
}
