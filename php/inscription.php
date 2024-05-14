<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="../CSS/inscription.css">
    <script src="../js/inscription.js"></script>
  </head>

  <body>
    <header>
      <?php
      require_once('../php/nav.php');
      ?>
    </header>
    
    <div id="inscription">
      <form action="inscription_verif.php" method="post" id="formulaire">
        
        <h2>Inscription</h2>

          <div class="control">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom">
            <span id="nomErr" class="err"></span>
          </div>

          <div class="control">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom">
            <span id="prenomErr" class="err"></span>
          </div>

          <div class="control">
            <label for="user">Nom d'utilisateur</label>
            <input type="text" id="user" name="user" >
            <span id="userErr" class="err"></span>
              <?php 
                  if(isset($_GET['userErr'])) { 
                    echo "<span id='user_double' style='color: rgba(255, 0, 0, 0.728); font-size: 12px;'>".$_GET['userErr']."</span>"; 
                  } 
                ?>
          </div>

          <div class="control">
            <label for="date">Date de naissance (AAAA/MM/JJ)</label>
            <input type="text" id="date" name="date" >
            <span id="dateErr" class="err"></span>
          </div>

          <div class="control">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" >
            <span id="emailErr" class="err"></span>
              <?php 
                if(isset($_GET['mailErr'])) { 
                  echo "<span id='mail_double' style='color: rgba(255, 0, 0, 0.728); font-size: 12px;'>".$_GET['mailErr']."</span><br>"; 
                } 
              ?>
          </div>

          <div class="control">
            <label for="email_verif">Confirmer Email</label>
            <input type="text" id="email_verif" name="email_verif" >
            <span id="email_verifErr" class="err"></span>
          </div>

          <div class="control">
            <label for="mdp">Mot de passe</label>
            <input type="password" id="mdp" name="mdp" >
            <span id="mdpErr" class="err"></span>
          </div>

          <div class="control">
            <label for="mdp_verif">Confirmer Mot de passe</label>
            <input type="password" id="mdp_verif" name="mdp_verif" >
            <span id="mdp_verifErr" class="err"></span>
          </div>

          <button type="submit">S'inscrire</button>

      </form>

    </div>
  </body>
</html>