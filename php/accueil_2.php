<?php

include '../database/db_co.php';
session_start();

if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Utilisateur non connecté']);
    exit;
}

$userId = $_SESSION['id'];

try {
    // Récupérer les post-its possédés par l'utilisateur
    $queryOwned = "SELECT * FROM Post
                   WHERE id_utilisateur = :userId
                   ORDER BY date_creation_post DESC";

    $stmt1 = $db->prepare($queryOwned);
    $stmt1->execute([':userId' => $userId]);
    $ownedPosts = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    // Récupérer les post-its partagés avec l'utilisateur
    $queryShared = "SELECT Post.*, Utilisateur.* FROM Post 
                    JOIN Partage ON Post.id_post = Partage.id_post
                    JOIN Utilisateur ON Post.id_utilisateur = Utilisateur.id_utilisateur 
                    WHERE Partage.id_utilisateur = :userId
                    ORDER BY Post.date_creation_post DESC";
                    
    $stmt2 = $db->prepare($queryShared);
    $stmt2->execute([':userId' => $userId]);
    $sharedPosts = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    // Encodage et envoi des données en JSON
    echo json_encode([
        'ownedPosts' => $ownedPosts,
        'sharedPosts' => $sharedPosts
    ]);

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
