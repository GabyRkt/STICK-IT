<?php
// accès à la base de données
include 'database\db_co.php';

// Récupérer les valeurs saisies dans le formulaire dans les variables
$titre = $_POST['titre'];
$contenu = $_POST['contenu'];
$couleur = $_POST['couleur'];
$police = $_POST['police'];
$taille = $_POST['taille'];
$id_user = 1; // L'utilisateur connecté (vous pouvez modifier ceci selon votre système de connexion)

// Dates de création et de modification
$date_create = date('Y-m-d H:i:s');
$date_modif = date('Y-m-d H:i:s');

// Insertion du post dans la table post
$reqSQL = "INSERT INTO `post`(`titre_post`, `contenu_post`, `date_creation_post`, `date_derniere_modif_post`, `code_couleur_post`, `police_post`, `taille_post`, `id_utilisateur`) 
           VALUES ('$titre', '$contenu', '$date_create', '$date_modif', '$couleur', '$police', '$taille', '$id_user')";

$stmt = $db->prepare($reqSQL);
$stmt->execute();

// Récupérer l'ID du post inséré
$id_post = $db->lastInsertId();

// Vérifier si des e-mails ont été envoyés via le formulaire
if (isset($_POST['emails'])) {
    // Récupérer les e-mails à partir du champ de formulaire
    $emails = $_POST['emails'];

    // Supprimer la virgule et le symbole "×" du dernier e-mail
    //$emails = rtrim($emails, ",");
    $emails = str_replace("×", "", $emails);

    // Séparer les e-mails en utilisant la virgule comme délimiteur
    $emailArray = explode(",", $emails);

   foreach ($emailArray as $email) {
    // Vérifier si l'utilisateur existe
     $email = trim($email);
    $id_utilisateur_post = $db->prepare("SELECT id_utilisateur FROM utilisateur WHERE email_utilisateur = :email");
    $id_utilisateur_post->execute(array(':email' => $email));
    $id_utilisateur = $id_utilisateur_post->fetchColumn();

    // Si l'utilisateur existe, insérer dans la table partage
    if ($id_utilisateur) {
        // Insérer chaque e-mail dans la table partage
        echo "ID utilisateur : $id_utilisateur, ID post : $id_post<br>"; // Affichage pour débogage
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

header('location:ajouter_post.html');

?>
