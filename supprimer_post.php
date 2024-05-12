<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/css_post_supp.css" type="text/css">
    <title>Supprimer</title>
</head>
<body>
    <h2>Supprimer un post-it</h2>
    <div class="post-it">
        <?php
        if (isset($_GET['id'])) {
            $post_id = $_GET['id'];
            include 'database\db_co.php';
            $sql = "SELECT titre_post FROM post WHERE id_post = :post_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $post_title = $stmt->fetch(PDO::FETCH_ASSOC)['titre_post'];
                echo "<p>Voulez-vous vraiment supprimer votre post-it intitulé : \"$post_title\" ?</p>";
            } else {
                echo "<p>Aucun post trouvé avec cet ID.</p>";
            }
        } else {
            echo "<p>Aucun ID de post spécifié.</p>";
        }
        ?>

        <form action="supp_post_2.php" method="post">
            <a class="delete-button" href='supp_post_2.php?id=<?php echo $post_id; ?>' style="text-decoration: none;">Supprimer</a>
            <button type="button" class="cancel-button" onclick="window.location.href = 'liste_post.php';">Annuler</button>
        </form>
    </div>
</body>
</html>

