<?php
require_once "includes/classes/utilisateur.php";
session_start();

$user = new utilisateur("","","","");
$user->SeDeconnecter();
