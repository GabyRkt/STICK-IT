<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Stick IT</title>
    <link rel="stylesheet" type="text/css" href="../CSS/accueil_new.css">
    <script src="../js/accueil.js"></script>
</head>
<body>
    <header>
    <?php
    require_once('../php/nav.php');
    ?>
    </header>
    
    <main class="flex-container">

        <section id="ownedPostIts" class="flex-item">
            <h2>Mes Post-its</h2>
            <!-- Emplacement pour les post-its personnels -->
        </section>

        <section id="sharedPostIts" class="flex-item">
            <h2>Post-its Partagés</h2>
            <!-- Emplacement pour les post-its partagés -->
        </section>
    </main>

</body>
</html>
