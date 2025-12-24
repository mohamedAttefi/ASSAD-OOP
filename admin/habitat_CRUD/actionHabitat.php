<?php
include '../../includes/db.php';
include '../includes/classes/admin.php';

$admin = new admin("", "", "");
if (isset($_POST['ajouterHabitat'])) {

    $nom = $_POST['nom'];
    $typeclimat = $_POST['typeclimat'];
    $zonezoo = $_POST['zonezoo'];
    $description = $_POST['description'];

    $admin->creerHabitat($conn, $nom, $typeclimat, $zonezoo, $description);



    header('location: ../gestion_habitats.php');
    exit;
}


if (isset($_POST['modifierHabitat'])) {

    $id = (int) $_POST['modifierHabitat'];
    $nom = $_POST['nom'];
    $typeclimat = $_POST['typeclimat'];
    $zonezoo = $_POST['zonezoo'];
    $description = $_POST['description'];

    $admin->modifierHabitat($conn, $id, $nom, $typeclimat, $zonezoo, $description);


    header('location: ../gestion_habitats.php');
    exit;
}
