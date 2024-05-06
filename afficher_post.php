<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style/AfficherPost.css" type="text/css" />
    <title>Afficher post</title>
</head>

<body>

    <?php include 'database\db_co.php'; ?>
    <br>
    <h2>Détails du post</h2>
    <br>

    <?php
    // Vérifie si l'identifiant du post est passé en paramètre dans l'URL
    if (isset($_GET['id'])) {
        // Récupère l'identifiant du post depuis l'URL
        $post_id = $_GET['id'];

        // Écriture de la requête pour récupérer les détails du post
        $sql = "SELECT * FROM post WHERE id_post = :id";
        // Préparation de la requête
        $stmt = $db->prepare($sql);
        // Liaison du paramètre
        $stmt->bindParam(':id', $post_id);
        // Exécution de la requête
        $stmt->execute();

        // Vérifie si le post existe dans la base de données
        if ($stmt->rowCount() > 0) {
            // Récupère les données du post
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Affiche les détails du post
            echo "<div class='post-details'>";
            echo "<h3>".$row['titre_post']."</h3>";
            echo "<p>".$row['contenu_post']."</p>";
            echo "</div>";
        } else {
            echo "<p>Aucun post trouvé avec cet identifiant.</p>";
        }
    } else {
        echo "<p>Identifiant du post non spécifié.</p>";
    }
    ?>

    <br>
    <a href="liste_post.php">Retour à la liste des posts</a>

</body>

</html>
