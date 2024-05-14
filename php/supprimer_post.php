<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: connexion.php');
        exit();
    }
    $user_id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/css_post_supp.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="../CSS/accueil.css">
    <title>Supprimer Post - Stick IT</title>
</head>
<body>
    <header>
    <?php
    require_once('../php/nav.php');
    ?>
    </header>
     
    <div class="post-it">
        <h2>Supprimer un post-it</h2>
        <br>
        <?php
        if (isset($_GET['id'])) {
            $post_id = $_GET['id'];
            include '../database/db_co.php';
          
            $sql = "SELECT titre_post FROM post WHERE id_post = :post_id AND id_utilisateur = :user_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $post_title = $stmt->fetch(PDO::FETCH_ASSOC)['titre_post'];
                $escaped_post_title = htmlspecialchars($post_title, ENT_QUOTES, 'UTF-8');
                echo "<p>Voulez-vous vraiment supprimer votre post-it intitulé : \"$escaped_post_title\" ?</p>";
            } else {
                echo "<p>Aucun post trouvé avec cet ID ou vous n'avez pas la permission de le supprimer.</p>";
            }
        } else {
            echo "<p>Aucun ID de post spécifié.</p>";
        }
        ?>

        <form action="supp_post_2.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($post_id, ENT_QUOTES, 'UTF-8'); ?>">
            <button type="submit" class="delete-button">Supprimer</button>
            <button type="button" class="cancel-button" onclick="window.location.href = 'accueil.php';">Annuler</button>
        </form>
    </div>

</body>
</html>
