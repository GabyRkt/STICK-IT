<?php

include '../database/db_co.php';

// Récupérer les valeurs saisies dans le formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$user = $_POST['user'];
$date = $_POST['date'];
$email = $_POST['email'];
$email_verif = $_POST['email_verif'];
$mdp = $_POST['mdp'];
$mdp_verif = $_POST['mdp_verif'];


// Vérifier si le nom d'utilisateur existe déjà
$reqSQL_user = "SELECT COUNT(*) FROM Utilisateur WHERE username_utilisateur = :user";
$req_user = $db->prepare($reqSQL_user);
$req_user-> execute(array(':user' => $user));
$count_user = $req_user->fetchColumn();

// Vérifier si le mail est déjà utilisé
$reqSQL_mail = "SELECT COUNT(*) FROM Utilisateur WHERE email_utilisateur = :email";
$req_mail = $db->prepare($reqSQL_mail);
$req_mail-> execute(array(':email' => $email));
$count_mail= $req_mail->fetchColumn();


if ($count_user  > 0) {
  echo "Ce nom d'utilisateur existe déjà."; }

  else if ($count_mail  > 0) {
    echo "Cet email est déjà utilisé.";}

    else { 

      // L'utilisateur n'existe pas, on crée l'utilisateur

      // Hacher le mot de passe
      $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

      // Insérer l'utilisateur dans la base de données
      $resSQL_insert = "INSERT INTO Utilisateur (username_utilisateur, nom_utilisateur, prenom_utilisateur, email_utilisateur, mdp_utilisateur, date_naissance_utilisateur) VALUES (:user, :nom, :prenom, :email, :mdp, :date)";

      $res_insert = $db->prepare($resSQL_insert);
      $res_insert->execute(array(
          ':user' => $user,
          ':nom' => $nom,
          ':prenom' => $prenom,
          ':email' => $email,
          ':mdp' => $mdp_hash,
          ':date' => $date
      ));

      if ($res_insert) {
          #echo "Inscription réussie !"; 
          
          $sql = "SELECT * FROM utilisateur WHERE email_utilisateur = ?";
          $req = $db->prepare($sql);
          $req->execute([$_POST['email']]);
          $user = $req->fetch(PDO::FETCH_ASSOC);

          session_start();
          $_SESSION['username'] = $user['username_utilisateur'];
          $_SESSION['id'] = $user['id_utilisateur'];

          header("Location: accueil.php");
      } else {
          #echo "Erreur lors de l'inscription.";
      }
}

?>
