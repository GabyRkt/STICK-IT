<nav>
    <div class="container">
        <div class="left">
            <a href="../php/accueil.php" class="logo">Stick IT</a>
        </div>
        <div class="right">
            <?php 
            if(!isset($_SESSION['id'])){
            ?>
            <a href="../php/connexion.php" class="nav-link">Connexion</a>
            <a href="../inscription.html" class="nav-link">Inscription</a>

            <?php
            }else{
            ?>
             <a href="../php/ajouter_post.php" class="nav-link">Ajouter un Post-it</a>
             <a href="../php/deconnexion.php" class="nav-link">Deconnexion</a>
             <a href="#" class="nav-link"><?php echo $_SESSION['username']?></a>
            <?php
            }
            ?>
           
            <div class="burger">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </div>
    </div>
</nav>
