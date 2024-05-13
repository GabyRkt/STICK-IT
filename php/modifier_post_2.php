<?php
// Connexion à la base de données
include '../database/db_co.php';

// On place les données du formulaire dans des variables
$id_post = $_POST["id"];
$titre = $_POST['titre'];
$contenu = $_POST['contenu'];
$couleur = $_POST['couleur'];
$police = $_POST['police'];
$taille = $_POST['taille'];
$date_modif = date('Y-m-d H:i:s');

// Requête de mise à jour pour le post
$reqSQL = "UPDATE post SET titre_post= :titre, contenu_post= :contenu, code_couleur_post= :couleur, police_post= :police, taille_post= :taille, date_derniere_modif_post= :date_modif WHERE id_post= :id_post";
$stmt = $db->prepare($reqSQL);
$stmt->bindParam(':id_post', $id_post, PDO::PARAM_INT);
$stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
$stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
$stmt->bindParam(':couleur', $couleur, PDO::PARAM_STR);
$stmt->bindParam(':police', $police, PDO::PARAM_STR);
$stmt->bindParam(':taille', $taille, PDO::PARAM_INT);
$stmt->bindParam(':date_modif', $date_modif, PDO::PARAM_STR);
$stmt->execute();

// Vérifier si des e-mails ont été envoyés via le formulaire
if (isset($_POST['emails'])) {
    // Récupérer les e-mails à partir du champ de formulaire
    $emails = $_POST['emails'];

    // Supprimer la virgule et le symbole "×" du dernier e-mail
    $emails = str_replace("×", "", $emails);

    // Séparer les e-mails en utilisant la virgule comme délimiteur
    $emailArray = explode(",", $emails);

    $sql_delete = "DELETE FROM partage WHERE id_post = $id_post"; // Requête SQL pour supprimer les partages pour le post spécifié
    $stmt_delete = $db->prepare($sql_delete); // Préparation de la requête SQL
    $stmt_delete->execute(); // Exécution de la requête SQL


    // Parcourir les nouveaux e-mails et les insérer dans la table partage
    foreach ($emailArray as $email) {
    // Vérifier si l'utilisateur existe
    $email = trim($email);
    $id_utilisateur_post = $db->prepare("SELECT id_utilisateur FROM utilisateur WHERE email_utilisateur = :email");
    $id_utilisateur_post->execute(array(':email' => $email));
    $id_utilisateur = $id_utilisateur_post->fetchColumn();

    // Si l'utilisateur existe, insérer dans la table partage
    if ($id_utilisateur) {
        // Insérer chaque e-mail dans la table partage
        $reqPartage = "INSERT INTO `partage`(`id_utilisateur`, `id_post`) 
                       VALUES (:id_utilisateur, :id_post)";
        $stmtPartage = $db->prepare($reqPartage);
        if (!$stmtPartage->execute(array(':id_utilisateur' => $id_utilisateur, ':id_post' => $id_post))) {
            // Afficher les erreurs s'il y en a
            print_r($stmtPartage->errorInfo());
        }
    } else {
        echo "L'utilisateur avec l'e-mail $email n'existe pas.<br>"; // Affichage pour débogage
    }
}
}

header('location:../php/accueil.php');
exit();
?>
