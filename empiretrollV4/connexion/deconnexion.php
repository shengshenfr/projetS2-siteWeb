<?php

session_start();

$_SESSION['estMembre'] = false;
$_SESSION['estAdmin'] = false;

header('Location: ../index.php');
?>