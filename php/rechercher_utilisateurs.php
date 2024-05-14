<?php
include '../database/db_co.php';

session_start();

if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Utilisateur non connecté']);
    exit;
}

$id_user = $_SESSION['id'];

$query = isset($_GET['query']) ? $_GET['query'] : '';

try {
    $stmt = $db->prepare("SELECT email_utilisateur FROM utilisateur WHERE email_utilisateur LIKE :query AND id_utilisateur != :id_user");
    $stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
    $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
    $stmt->execute();
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode(array_column($resultats, 'email_utilisateur'));
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur lors de l\'exécution de la requête: ' . $e->getMessage()]);
}
?>
