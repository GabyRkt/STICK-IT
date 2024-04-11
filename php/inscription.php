<?php

include 'database\db_co.php';

//verifier si l'utilisateur à déjà un compte
$sql_verif = "SELECT COUNT(*) FROM Utilisateur WHERE username_utilisateur = :username OR email_utilisateur = :email";
$req = $db->prepare($sql_verif);
$req->execute(array(':username' => $_POST['username'], ':email' => $_POST['email']));
$count = $req->fetchColumn();

if ($count > 0){
  echo "Vous avez déjà un compte.";
  exit;
}else{
  echo "ok";
}
 ?>
