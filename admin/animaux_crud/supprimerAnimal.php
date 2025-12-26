<?php
include '../includes/db.php';
include '../includes/classes/animaux.php';


if (isset($_POST['supprimerAnimal'])) {
    $id = $_POST['supprimerAnimal'];
    animaux::supprimerAnimal($conn, $id);
    header('location: ../gestion_animaux.php');
    exit;
}
