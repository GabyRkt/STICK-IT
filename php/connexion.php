<?php
session_start();
//fbloquer la page de connexion une fois que la session de l'utilisateur est ouverte
?>
<!DOCTYPE html>
<html>
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
    <h2>Connexion</h2>
    <form action="connexion_verif.php" method="post" id="connexion">

      <div class = "form-cont">
        <label for="email">Email :</label><br>
        <input type="text" id="email" name="email" ><br>
        <span id="emailErr" class="err"></span>
      </div>

      <div class ="form-cont">
        <label for="mdp">Mot de passe :</label><br>
        <input type="password" id="mdp" name="mdp" ><br><br>
        <span id="mdpErr" class="err"></span>
      </div>
      
      <input type="submit" value="Se connecter"><br>
      <div id="err_msg">
        <?php 
        if(isset($_GET['mdpErr'])) { 
          echo "<span class='err'>" . $_GET['mdpErr'] . "</span><br>"; 
          } ?>

        <?php 
        if(isset($_GET['compteErr'])) { 
          echo "<span class='err'>" . $_GET['compteErr'] . "</span><br>"; 
          } ?>
      </div>
      
    </form>

  </body>
</html>