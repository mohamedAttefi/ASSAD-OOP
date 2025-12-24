<?php
include '../includes/db.php';
include '../includes/classes/admin.php';
$admin = new admin("", "", "");


if (isset($_POST['supprimerAnimal'])) {
    $id = $_POST['supprimerAnimal'];
    $admin->supprimerAnimal($conn, $id);
    header('location: ../gestion_animaux.php');
    exit;
}
