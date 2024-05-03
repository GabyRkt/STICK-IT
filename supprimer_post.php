<style>
    
</style>

<?php
// Vérifier si un ID de post est passé via GET
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    
    // Inclure le fichier de connexion à la base de données
    include 'database\db_co.php';

    // Préparer la requête SQL pour récupérer le titre du post en fonction de son ID
    $sql = "SELECT titre_post FROM post WHERE id_post = :post_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->execute();

    // Vérifier si le post existe
    if ($stmt->rowCount() > 0) {
        // Récupérer le titre du post
        $post_title = $stmt->fetch(PDO::FETCH_ASSOC)['titre_post'];
        
        // Afficher le message de confirmation avec le titre du post
        echo "<p>Voulez-vous vraiment supprimer votre post-it intitulé : \"$post_title\" ?</p>";
    } else {
        echo "<p>Aucun post trouvé avec cet ID.</p>";
    }
} else {
    echo "<p>Aucun ID de post spécifié.</p>";
}
?>

<!-- Formulaire de confirmation de suppression -->
<form action="supp_post_2.php" method="post">
    <a href='supp_post_2.php?id=<?php echo $post_id; ?>'>Supprimer</a>
    <button type="button" onclick="window.location.href = 'liste_post.php';">Annuler</button>
</form>

