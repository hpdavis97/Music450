<?php
session_start();
$_SESSION['lookupUser'] = "valid";
header("Location: ../home/home.php");
 ?>
