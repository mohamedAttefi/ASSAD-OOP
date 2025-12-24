<?php
session_start();
include '../../includes/db.php';
include '../../includes/classes/guide.php';
$guide = new guide("", "", "");

if (isset($_POST['supprimer'])) {

    $id = (int) $_POST['supprimer'];
    $guide->annuleeVisite($id, $conn);
}


if (isset($_POST['modifier'])) {

    $id = (int) $_POST['modifier'];
    $titre = $_POST['titre'];
    $dateheure = $_POST['dateheure'];
    $langue = $_POST['langue'];
    $capacite_max = (int) $_POST['capacite_max'];
    $statut = $_POST['statut'];
    $duree = (int) $_POST['duree'];
    $prix = (float) $_POST['prix'];
    $guide->modifierVisite($conn, $titre,$dateheure,$langue,$capacite_max,$statut,$duree,$prix,$id_visite);
}

if (isset($_POST['ajouter'])) {

    $titre = $_POST['titre'];
    $dateheure = $_POST['dateheure'];
    $duree = $_POST['duree'];
    $prix = $_POST['prix'];
    $statut = $_POST['statut'];
    $capacite_max = $_POST['capacite_max'];
    $langue = $_POST['langue'];
    $id = $_SESSION['user_id'];


    $guide->ajouterVisite($conn, $titre, $dateheure, $langue, $capacite_max, $statut, $duree, $prix, $id);
}
