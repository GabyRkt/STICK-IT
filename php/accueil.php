<?php

include '../database/db_co.php';
session_start();

if (!isset($_SESSION['userId'])) {
    echo json_encode(['error' => 'Utilisateur non connecté']);
    exit;
}

$userId = $_SESSION['userId'];

try {
    $query = "SELECT * FROM Post WHERE id_utilisateur = :userId";
    $stmt = $db->prepare($query);
    $stmt->execute([':userId' => $userId]);

    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($posts);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
