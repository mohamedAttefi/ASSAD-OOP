<?php
include "classes/DbConnection.php";

$dbconnection = new DbConnection("localhost", "assad", 'root', "ME551234", 3307);
$conn = $dbconnection->connectDB();
?>