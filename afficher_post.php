<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails post</title>
    <link rel="stylesheet" href="CSS/afficher_post.css" type="text/css">
    <script src="scripts.js"></script>
</head>

<body>
    <?php include 'database\db_co.php'; ?>
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
            echo "
            <div class='header'>".$row['titre_post']."</div>
                <div class='container' style='text-align: center;>
                <div class='post-details' style='text-align: start;'>                
                    <div class='post-text' style='color:".$row['code_couleur_post']."; font-size:".$row['taille_post']."; font-family:".$row['police_post'].";'><p>".$row['contenu_post']."</p></div>
                    <div class='post-details'></div>
                    <a class='back-link' style='text-align: left;' href='liste_post.php'>Retour à la liste des posts</a> 
                    
                </div>
            </div>
          "
;
        } else {
            echo "<p>Aucun post trouvé avec cet identifiant.</p>";
        }
    } else {
        echo "<p>Identifiant du post non spécifié.</p>";
    }
    ?>
</body>
</html>
