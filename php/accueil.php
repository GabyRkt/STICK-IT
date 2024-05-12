<?php

include '../database/db_co.php'; // Assurez-vous que le chemin vers votre script de connexion est correct

try {
    // Récupération de toutes les entrées de la table Post
    $query = "SELECT * FROM Post";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($posts);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
