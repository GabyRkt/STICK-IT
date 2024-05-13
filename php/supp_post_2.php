<?php
// Vérifier si un ID de post est passé via GET
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    
    // Inclure le fichier de connexion à la base de données
    include '../database/db_co.php';

    try {
        // Début de la transaction
        $db->beginTransaction();

        // Requête de suppression des données liées dans la table partage
        $reqSQLPartage = "DELETE FROM partage WHERE id_post=:post_id";
        $stmtPartage = $db->prepare($reqSQLPartage);
        $stmtPartage->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmtPartage->execute();

        // Requête de suppression du post dans la table post
        $reqSQLPost = "DELETE FROM post WHERE id_post=:post_id";
        $stmtPost = $db->prepare($reqSQLPost);
        $stmtPost->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmtPost->execute();

        // Validation de la transaction
        $db->commit();

        // Rediriger vers la liste des posts
        header('location:../php/accueil.php');
    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $db->rollBack();
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
} else {
    echo "<p>Aucun ID de post spécifié.</p>";
}
?>
