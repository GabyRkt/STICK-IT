<?php
session_start();
if (isset($_SESSION['id'])) {
  header('Location: accueil.php');
  exit();
}
//bloquer la page de connexion une fois que la session de l'utilisateur est ouverte
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="../CSS/connexion.css">
    <script src="../js/connexion.js"></script>
  </head>
  <body>
  <header>
    <?php
    require_once('../php/nav.php');
    ?>
    </header>
    
    <form action="connexion_verif.php" method="post" id="connexion">
      <h2>Connexion</h2>
      <div class = "form-cont">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" >
        <span id="emailErr" class="err"></span>
      </div>

      <div class ="form-cont">
        <label for="mdp">Mot de passe</label>
        <input type="password" id="mdp" name="mdp" >
        <span id="mdpErr" class="err"></span>
      </div>
      
      <input type="submit" value="Se connecter"><br>
      <div id="err_msg">
        <?php 
        if(isset($_GET['mdpErr'])) { 
          echo "<span class='err' style='color: rgba(255, 0, 0, 0.728); font-size: 12px;'>" . $_GET['mdpErr'] . "</span>"; 
          } ?>

        <?php 
        if(isset($_GET['compteErr'])) { 
          echo "<span class='err' style='color: rgba(255, 0, 0, 0.728); font-size: 12px;' >" . $_GET['compteErr'] . "</span>"; 
          } ?>
      </div>
      
    </form>

  </body>
</html>