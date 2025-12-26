<?php 
include '../../includes/db.php';
include '../../includes/classes/visiteur.php';

if (isset($_POST['activerCompte'])) {
    $id = $_POST['activerCompte'];

    visiteur::activerUtilisateurs($conn, $id);

    header('location: ../gestion_utilisateurs.php');
    exit;
}
if (isset($_POST['desactiverCompte'])) {
    $id = $_POST['desactiverCompte'];

    visiteur::desactiverUtilisateurs($conn, $id);

    header('location: ../gestion_utilisateurs.php');
    exit;
}