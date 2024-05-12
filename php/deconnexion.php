<?php
session_start();
$_SESSION = array();
session_destroy();
header('Location: ../php/accueil_new.php');
exit();
?>