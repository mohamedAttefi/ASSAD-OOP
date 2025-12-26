<?php
include '../includes/db.php';
include '../includes/classes/animaux.php';



if (isset($_POST['ajouterAnimal'])) {
    $nom = $_POST['nom'];
    $espece = $_POST['espece'];
    $alimentation = $_POST['alimentation'];
    $image = $_POST['image'];
    $paysorigine = $_POST['paysorigine'];
    $descriptioncourte = $_POST['descriptioncourte'];
    $id_habitat = $_POST['id_habitat'];

    $animal = new animaux($nom, $espece, $alimentation, $paysorigine, $image, $id_habitat, $descriptioncourte);

    $animal->creerAnimal($conn);

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

    $animal = new animaux($nom, $espece, $alimentation, $paysorigine, $image, $id_habitat, $descriptioncourte);

    $animal->modifierAnimal($conn, $id);

    header('location: ../gestion_animaux.php');
    exit;
}
