<?php
include 'Database/db_co.php'; // Chemin d'accès relatif au fichier db_co.php

$userId = YOUR_USER_ID; // Remplacez par l'ID utilisateur actuel

// Récupérer vos propres Post-its
$stmt1 = $db->prepare("SELECT id_post, titre_post, contenu_post, date_creation_post FROM post WHERE id_utilisateur = :userId");
$stmt1->execute(['userId' => $userId]);
$ownedPostIts = $stmt1->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les Post-its partagés avec vous
$stmt2 = $db->prepare("SELECT p.id_post, p.titre_post, p.contenu_post, p.date_creation_post FROM partage pa JOIN post p ON pa.id_post = p.id_post WHERE pa.id_utilisateur = :userId");
$stmt2->execute(['userId' => $userId]);
$sharedPostIts = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// Inclure les vues HTML ici, et les variables PHP seront accessibles dans ces fichiers
include 'accueil.html'; // L'accueil de votre site
?>
