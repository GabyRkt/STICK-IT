<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/css_post_supp.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="../CSS/accueil.css">
    <title>Supprimer User</title>
</head>
<body>
    <header>
    <?php
    require_once('../php/nav.php');
    ?>
    </header>
     
    <div class="supp-user">
        <h2>Supprimer Utilisateur - Stick IT</h2>
        <br>
        <?php
        if (isset($_GET['id'])) {
            $user_id = $_GET['id'];
            include '../database/db_co.php';
            $sql = "SELECT user FROM utilisateur WHERE id_post = :post_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $post_title = $stmt->fetch(PDO::FETCH_ASSOC)['titre_post'];
                $escaped_post_title = htmlspecialchars($post_title, ENT_QUOTES, 'UTF-8');
                echo "<p>Voulez-vous vraiment supprimer votre post-it intitulé : \"$escaped_post_title\" ?</p>";
            } else {
                echo "<p>Aucun post trouvé avec cet ID.</p>";
            }
        } else {
            echo "<p>Aucun ID de post spécifié.</p>";
        }
        ?>

        <form action="supp_post_2.php" method="post">
            <a class="delete-button" href='supp_post_2.php?id=<?php echo htmlspecialchars($post_id, ENT_QUOTES, 'UTF-8'); ?>' style="text-decoration: none;">Supprimer</a>
            <button type="button" class="cancel-button" onclick="window.location.href = 'accueil.php';">Annuler</button>
        </form>
    </div>

</body>
</html>