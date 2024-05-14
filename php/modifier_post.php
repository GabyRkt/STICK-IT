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
        <link rel="stylesheet" href="../CSS/css_post_add.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="../CSS/accueil.css">
        <title>Modifier</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
        <script src="../js/add_update_post_js.js"></script> 
    </head>

<body>

    <header>
        <?php
        require_once('../php/nav.php');
        ?>
    </header>

<?php
// Vérifier si un ID de post est passé via GET
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Inclure le fichier de connexion à la base de données
    include '../database/db_co.php';

    // Préparer la requête SQL pour récupérer le titre et le contenu du post en fonction de son ID
    $sql = "SELECT id_post, titre_post, contenu_post, code_couleur_post, police_post, taille_post FROM post WHERE id_post = :post_id AND id_utilisateur = :user_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    // Vérifier si le post existe
    if ($stmt->rowCount() > 0) {
        // Récupérer les données du post
        $post_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $post_titre = $post_data['titre_post'];
        $post_contenu = $post_data['contenu_post'];
        $post_couleur = $post_data['code_couleur_post'];
        $post_police = $post_data['police_post'];
        $post_taille = $post_data['taille_post'];

        // Récupérer les emails avec lesquels le post est partagé
        $sql_partage = "SELECT utilisateur.email_utilisateur FROM partage 
                        INNER JOIN utilisateur ON partage.id_utilisateur = utilisateur.id_utilisateur 
                        WHERE partage.id_post = :post_id";
        $stmt_partage = $db->prepare($sql_partage);
        $stmt_partage->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt_partage->execute();
        $emails_partages = $stmt_partage->fetchAll(PDO::FETCH_COLUMN);

        // Afficher le formulaire de modification avec les données du post
        ?>

        <section id="form_ajouter" class="form_ajouter">
            <h2>Modifier un post-it</h2>
            <div id="content" class="content">
                <form  id="emailForm" action="modifier_post_2.php" method="POST">                
                    <input name="id" type="hidden" value="<?php echo $post_data['id_post']; ?>">
                    <label for="titre">Titre :</label>
                    <textarea id="titre" name="titre" rows="3" required><?php echo $post_titre; ?></textarea>
                    <span id="titreErr" class="err"></span>
                    <br>
                    <label for="contenu">Contenu : </label>
                    <textarea id="contenu" name="contenu" rows="4" cols="255" maxlength="255" required><?php echo htmlspecialchars($post_contenu); ?></textarea>
                    <span id="contenuErr" class="err"></span>
                    <br>    
                    <label for="couleur">Couleur :</label>
                    <input name="couleur" id="couleur" type="color" size="25" value="<?php echo htmlspecialchars($post_couleur); ?>">
                    <br>
                    <label for="police">Police :</label>
                    <select id="police" name="police">
                        <option value="Arial" <?php if($post_police == 'Arial') echo 'selected'; ?>>Arial</option>
                        <option value="Verdana" <?php if($post_police == 'Verdana') echo 'selected'; ?>>Verdana</option>
                        <option value="Tahoma" <?php if($post_police == 'Tahoma') echo 'selected'; ?>>Tahoma</option>
                        <option value="Courier New" <?php if($post_police == 'Courier New') echo 'selected'; ?>>Courier New</option>
                        <option value="Times New Roman" <?php if($post_police == 'Times New Roman') echo 'selected'; ?>>Times New Roman</option>
                    </select>
                    <br>
                    <label for="taille">Taille :</label>
                    <select id="taille" name="taille">
                        <option value="12" <?php if($post_taille == '11') echo 'selected'; ?>>12</option>
                        <option value="14" <?php if($post_taille == '14') echo 'selected'; ?>>14</option>
                        <option value="16" <?php if($post_taille == '16') echo 'selected'; ?>>16</option>
                    </select>
                    <br>
                    <label for="email">Partager avec :</label><br>
                    <div id="emailBubbles">
                        <?php foreach ($emails_partages as $email) { ?>
                            <div class="emailBubble"><?php echo $email; ?><span class="close" onclick="removeEmailBubble(this)">×</span></div>
                        <?php } ?>
                    </div>
                    <input type="hidden" name="emails" id="emails" value="<?php echo implode(',', $emails_partages); ?>">
                    <input type="text" id="email" name="email" minlength="3">
                    <select id="emailList" multiple style="display: none;">
                        <!-- Dropdown options will be populated dynamically -->
                    </select>
                    <div id="notFound" style="display: none;">Utilisateur introuvable</div>
                    <br>                   
                    <input type="submit" value="Modifier" onclick="return checkTitleLength()"> 
                </form>
            </div>
        </section>

        <?php
    } else {
        echo "<p>Aucun post trouvé avec cet ID.</p>";
    }
} else {
    echo "<p>Aucun ID de post spécifié.</p>";
}
?>

</body>

</html>
