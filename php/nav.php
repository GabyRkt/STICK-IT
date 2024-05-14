<nav>
    <div class="container">
        <div class="left">
            <?php 
            if(!isset($_SESSION['id'])){
            ?>
            <a href="../php/main.php" class="logo">Stick IT</a>
            <?php
            }else{
            ?>
            <a href="../php/accueil.php" class="logo">Stick IT</a>
            <?php
            }
            ?>
        </div>
        <div class="right">
            <?php 
            if(!isset($_SESSION['id'])){
            ?>
            <a href="../php/connexion.php" class="nav-link">Connexion</a>
            <a href="../php/inscription.php" class="nav-link">Inscription</a>

            <?php
            }else{
            ?>
             <a href="../php/ajouter_post.php" class="nav-link">+ Ajouter un Post-it</a>
             <a href="../php/deconnexion.php" class="nav-link">Déconnexion</a>
             <a href="#" class="nav-link"><img src="../icons/person-square.svg" style="color: white; font-size: 24px; margin-right: 10px;"> <?php echo $_SESSION['username']?></a>
            <?php
            }
            ?>
            
        </div>
    </div>
</nav>
