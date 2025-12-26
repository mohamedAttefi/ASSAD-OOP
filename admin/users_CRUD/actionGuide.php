<?php
include '../../includes/db.php';
include '../../includes/classes/guide.php';

if (isset($_POST['approuvee'])) {
    $id = $_POST['approuvee'];

    guide::approuveeGuide($conn, $id);

    header('location: ../gestion_utilisateurs.php');
    exit;
}

if (isset($_POST['desapprouvee'])) {
    $id = $_POST['desapprouvee'];

    guide::desapprouveeGuide($conn, $id);

    header('location: ../gestion_utilisateurs.php');
    exit;
}
