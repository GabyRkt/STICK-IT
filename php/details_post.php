<?php
   session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: connexion.php');
        exit();
    }
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
    </header>

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

            //Change le format de la date affichée
            $date_creation = $row['date_creation_post'];
            $date_modification = $row['date_derniere_modif_post'];

            // Création d'un objet DateTime avec la date récupérée
            $date_creation_obj = new DateTime($date_creation);
            $date_modification_obj = new DateTime($date_modification);

            // Définition de la locale en français
            setlocale(LC_TIME, 'fr_FR.UTF-8');

            // Formatage de la date en français avec les heures et les minutes
            $date_creation_formatee = strftime("%A %e %B %Y à %H:%M", $date_creation_obj->getTimestamp());
            $date_modification_formatee = strftime("%A %e %B %Y à %H:%M", $date_modification_obj->getTimestamp());


            $sql = "SELECT id_post, titre_post, contenu_post, code_couleur_post, police_post, taille_post FROM post WHERE id_post = :post_id AND id_utilisateur = :user_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            // Récupérer le username du propriétaire 
            $sql_utilisateur = "SELECT utilisateur.username_utilisateur FROM post 
            INNER JOIN utilisateur ON post.id_utilisateur = utilisateur.id_utilisateur 
            WHERE post.id_post = :post_id";
            $stmt_utilisateur = $db->prepare($sql_utilisateur);
            $stmt_utilisateur->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $stmt_utilisateur->execute();
            $username = $stmt_utilisateur->fetchAll(PDO::FETCH_COLUMN);

            // Récupérer les emails avec lesquels le post est partagé
            $sql_partage = "SELECT utilisateur.email_utilisateur FROM partage 
            INNER JOIN utilisateur ON partage.id_utilisateur = utilisateur.id_utilisateur 
            WHERE partage.id_post = :post_id";
            $stmt_partage = $db->prepare($sql_partage);
            $stmt_partage->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $stmt_partage->execute();
            $emails_partages = $stmt_partage->fetchAll(PDO::FETCH_COLUMN);
            ?>
            
           <div class='titre'></div>
           <div class='container-post' style='text-align: center;background-color:<?php echo $row['code_couleur_post']; ?>;'>
                <div class='titre' style="display: flex; align-items: center; justify-content: center;"> 
                    <?php echo htmlspecialchars($row['titre_post'], ENT_QUOTES, 'UTF-8')?>
                    <div style="margin-left: auto;">
                    <?php 
                    // Modification possible que pour le propriétaire du post
                    if (in_array($_SESSION['username'], $username)) {
                    ?>
                        <!-- Affichage des boutons de modification et de suppression -->
                        <a class="button" href="../php/modifier_post.php?id=<?php echo $_GET['id']; ?>" style="text-decoration:none;"><img src="../icons/pencil-square.svg"></a>
                        <a class="button" href="../php/supprimer_post.php?id=<?php echo $_GET['id']; ?>" style="text-decoration:none;"><img src="../icons/trash-fill.svg"></a>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="container">
                    <p>Propriétaire : <?php echo implode(',', $username);  ?></p>
                </div>
                <br>
                <hr>
                <div class='post-text' style='background-color:<?php echo $row['code_couleur_post']; ?>;font-size:<?php echo $row['taille_post']; ?>; font-family:<?php echo $row['police_post']; ?>;'><p><?php echo htmlspecialchars($row['contenu_post'], ENT_QUOTES, 'UTF-8') ?></p></div>
                <hr>
                <br>
                <br>
                <div class="container">
                    <div>Crée le : <?php echo $date_creation_formatee; ?></div>
                    <div>Dernière modification le : <?php echo $date_modification_formatee; ?></div>
                </div>
                <br>
                <hr>           
                <div class="container">
                    <h3>Partagé avec :</h3>
                </div>
                <div class="container">
                    <?php echo implode(',', $emails_partages); ?>
                </div>
                    <a class='back-link' style='text-align: left; background-color:#FFBC70' href='../php/accueil.php'>Retour à la liste des posts</a> 
            </div>      
        <?php
        }
    } else {
        echo "<div class='container'>Aucun post trouvé avec cet ID.</div>";
    }
    ?>
</body>
</html>
