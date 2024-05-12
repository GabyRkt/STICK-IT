<?php
session_start();

// Vérifie si l'utilisateur est connecté
if(isset( $_SESSION['id'])) {
    // L'utilisateur est connecté, afficher son pseudo
    $username = $_SESSION['username'];
    echo "Bienvenue, $username ";
} else {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: connexion.php");
    exit(); // Arrêter l'exécution du script après la redirection
}
?>
