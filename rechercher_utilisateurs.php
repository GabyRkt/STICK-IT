<?php
include 'database\db_co.php'; // Include your database connection file

$query = isset($_GET['query']) ? $_GET['query'] : '';

$stmt = $db->prepare("SELECT email_utilisateur FROM utilisateur WHERE email_utilisateur LIKE :query");
$stmt->execute(['query' => '%' . $query . '%']);
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode(array_column($resultats, 'email_utilisateur'));
?>
