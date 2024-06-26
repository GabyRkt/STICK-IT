<?php
//connexion bd
include '../database/db_co.php';

//Variable pour le message d'erreur
$compteErr = $mdpErr = "";

//Vérifier que l'utilisateur soit dans la bdd

//Requête pour vérifier si l'e-mail correspond dans la bdd
$sql = "SELECT * FROM utilisateur WHERE email_utilisateur = ?";
$req = $db->prepare($sql);
$req->execute([$_POST['email']]);


if($req->rowCount() > 0){
    //L'utilisateur a un compte. 
    //Vérification que le mot de passe correspond a celui de la bd
    $user = $req->fetch(PDO::FETCH_ASSOC);
    $mdp_formu = $_POST['mdp'];
    $mdp_bd = $user['mdp_utilisateur'];

    //Vérifie le mot de passe (à changer)
    if(password_verify($mdp_formu, $user['mdp_utilisateur'])) {
        //Connexion réussie

        //Démarre la session et on stocke le username et l'id de l'utilisateur
        session_start();
        $_SESSION['username'] = $user['username_utilisateur'];
        $_SESSION['id'] = $user['id_utilisateur'];

        //Redirection ver la page d'accueil
        header("Location: accueil.php");
        exit();
    } else {
        #echo "mot de passe ou email incorrect.";
        $mdpErr = "Votre mot de passe ou votre email est incorrect";
    }

}else {
    //L'utilisateur n'a pas de compte.
    #echo "aucun compte";
    $compteErr = "Vous n'avez pas de compte";
}

header("Location: ../php/connexion.php?mdpErr=$mdpErr&compteErr=$compteErr");
exit();
?>