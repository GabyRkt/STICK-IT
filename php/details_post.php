<?php
   session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails post</title>
    <link rel="stylesheet" type="text/css" href="../CSS/details_post.css">
    <script src="scripts.js"></script>
</head>

<body>
<header>
    <?php
    require_once('../php/nav.php');
    ?>
    </header>
    <?php include '../database/db_co.php'; ?>

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
           ?> 
            <div class='titre'><?php echo $row['titre_post']; ?></div>
                <div class='container-post' style='text-align: center;'>
                    <div class='post-details' style='text-align: start;'> </div>               
                        <div class='post-text' style='background-color:<?php echo $row['code_couleur_post']; ?>; font-size:<?php echo $row['taille_post']; ?>; font-family:<?php echo $row['police_post']; ?>;'><p><?php echo $row['contenu_post']; ?></p></div>
                        <div class='post-details'></div>
                        <a class='back-link' style='text-align: left;' href='../php/accueil.php'>Retour à la liste des posts</a> 
                    
                </div>
<?php
        } else {
            ?>
            <div class='titre'>Identifiant indisponible</div>
                <div class='container-post' style='text-align: center;'>
                    <div class='post-details' style='text-align: start;'> </div>               
                    <div class='post-text'><p>Ce post-it n'existe pas</p></div>
                    <div class='post-details'></div>
                    <a class='back-link' style='text-align: left;' href='../php/accueil.php'>Retour à la liste des posts</a>   
            </div>

        <?php
        }
    } else {
        ?>
            <div class='titre'>Identifiant non spécifié</div>
                <div class='container-post' style='text-align: center;'>
                    <div class='post-details' style='text-align: start;'> </div>               
                    <div class='post-text'><p>Veuillez entrer un identifiant</p></div>
                    <div class='post-details'></div>
                    <a class='back-link' style='text-align: left;' href='../php/accueil.php'>Retour à la liste des posts</a>   
            </div>

        <?php
    }
    ?>
</body>
</html>
