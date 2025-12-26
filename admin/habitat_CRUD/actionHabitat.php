<?php
include '../../includes/db.php';
include '../includes/classes/admin.php';

if (isset($_POST['ajouterHabitat'])) {

    $nom = $_POST['nom'];
    $typeclimat = $_POST['typeclimat'];
    $zonezoo = $_POST['zonezoo'];
    $description = $_POST['description'];

    $habitat = new habitat($nom, $typeclimat, $description, $zonezoo);

    $habitat->creerHabitat($conn);

    header('location: ../gestion_habitats.php');
    exit;
}


if (isset($_POST['modifierHabitat'])) {

    $id = $_POST['modifierHabitat'];
    $nom = $_POST['nom'];
    $typeclimat = $_POST['typeclimat'];
    $zonezoo = $_POST['zonezoo'];
    $description = $_POST['description'];

    $habitat = new habitat($nom, $typeclimat, $description, $zonezoo);

    $habitat->modifierHabitat($conn, $id);

    header('location: ../gestion_habitats.php');
    exit;
}
