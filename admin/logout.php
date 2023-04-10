<?php
session_start(); // Démarrage de la session

// Destruction des variables de session
$_SESSION = array();
session_destroy();

// Redirection vers la page de login
header("Location: ../index.php?page");
exit();
?>