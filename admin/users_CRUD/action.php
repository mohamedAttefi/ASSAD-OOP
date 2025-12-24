<?php
include '../../includes/db.php';
include '../includes/classes/admin.php';

$admin = new admin("", "", "");

if (isset($_POST['approuvee'])) {
    $id = $_POST['approuvee'];

    $admin->approuveeGuide($conn, $id);

    header('location: ../gestion_utilisateurs.php');
    exit;
}
if (isset($_POST['desapprouvee'])) {
    $id = $_POST['desapprouvee'];

    $admin->desapprouveeGuide($conn, $id);

    header('location: ../gestion_utilisateurs.php');
    exit;
}
if (isset($_POST['supprimerUser'])) {
    $id = $_POST['supprimerUser'];

    $admin->supprimerUtilisateur($conn, $id);

    echo $id;
    header('location: ../gestion_utilisateurs.php');
    exit;
}
print_r($_POST);
