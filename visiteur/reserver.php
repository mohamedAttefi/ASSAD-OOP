<?php
include "../includes/db.php";
include "../includes/classes/reservation.php";
session_start();

$id = $_GET['id'];
echo $id;
$reservation = new reservation("","","","","");

$reservation->ajouterReservation($conn, $id);