<?php
session_start();

$_SESSION = [];

session_destroy();


header("Location: ASSAD/ASSAD/index.php");
exit;
