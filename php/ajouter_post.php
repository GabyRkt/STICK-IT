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

    <section>

        <h2>Ajouter un post-it</h2>

        <div id="content" class="content">

            <form  id="emailForm" action="ajouter_2.php" method="POST">                
                <label for="titre">Titre : </label>   
                <input type="text"  id="titre" name="titre"  size="25" required>
                <br>                
                <label for="contenu">Contenu : </label>
                <textarea id="contenu" name="contenu" rows="4" cols="25" required></textarea>
                <br>             
                <label for="couleur">Couleur :</label>   
                <input type="color" id="couleur" name="couleur" value="#FFFFFF" size="35">
                <br>                
                <label for="police">Choisir une police :</label>
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
                    <option value="11">11</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
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
