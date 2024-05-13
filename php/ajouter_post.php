<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../CSS/css_post_add.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="../CSS/accueil.css">
	<title>Ajouter</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/add_update_post_js.js"></script> 	
</head>

<body>

    <header>
    <?php
    require_once('../php/nav.php');
    ?>
    </header>

    <section id="form_ajouter" class="form_ajouter">

        <h2>Ajouter un post-it</h2>

        <div id="content" class="content">

            <form  id="emailForm" action="ajouter_2.php" method="POST">                
                <label for="titre">Titre : </label>   
                <textarea id="titre" name="titre" rows="3" cols="150" maxlength="150" required></textarea>
                <br>                
                <label for="contenu">Contenu : </label>
                <textarea id="contenu" name="contenu" rows="4" cols="255" maxlength="255" required></textarea>
                <br>             
                <label for="couleur">Couleur :</label>   
                <input type="color" id="couleur" name="couleur" value="#FFFFFF" size="35">
                <br>                
                <label for="police">Police :</label>
                  <select id="police" name="police">
                    <option value="Arial">Arial</option>
                    <option value="Verdana">Verdana</option>
                    <option value="Tahoma">Tahoma</option>
                    <option value="Courier New">Courier New</option>
                    <option value="Times New Roman">Times New Roman</option>
                  </select>
                <br>
                <label for="taille">Taille : </label>   
                <select id="taille" name="taille">
                    <option value="12">12</option>
                    <option value="14">14</option>
                    <option value="16">16</option>
                </select>
                <br>
                <label for="email">Partager avec :</label>
                <br>
                <div id="emailBubbles"></div>
                <input type="hidden" name="emails" id="emails">
                <input type="text" id="email" name="email" minlength="3">
                <select id="emailList" multiple style="display: none;">
                </select>
                <div id="notFound" style="display: none;">Utilisateur introuvable</div>
                <br>                   
                <input type="submit" value="Ajouter"> 
            </form>
        </div>
    </section>
</body>
</html>
