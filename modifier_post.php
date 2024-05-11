<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css_post_add.css" type="text/css" />
        <title>Modifier</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    
    <style>
    .emailBubble {
        display: inline-block;
        background-color: #cdeac0;
        color: #006400;
        padding: 5px 10px;
        border-radius: 20px;
        margin-right: 5px;
    }
    .emailBubble .close {
        cursor: pointer;
        margin-left: 5px;
    }
</style>
    </head>


<body>


<?php
// Vérifier si un ID de post est passé via GET
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Inclure le fichier de connexion à la base de données
    include 'database\db_co.php';

    // Préparer la requête SQL pour récupérer le titre et le contenu du post en fonction de son ID
    $sql = "SELECT id_post, titre_post, contenu_post, code_couleur_post, police_post, taille_post FROM post WHERE id_post = :post_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->execute();

    // Vérifier si le post existe
    if ($stmt->rowCount() > 0) {
        // Récupérer les données du post
        $post_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $post_titre = $post_data['titre_post'];
        $post_contenu = $post_data['contenu_post'];
        $post_couleur = $post_data['code_couleur_post'];
        $post_police = $post_data['police_post'];
        $post_taille = $post_data['taille_post'];

        // Récupérer les emails avec lesquels le post est partagé
        $sql_partage = "SELECT utilisateur.email_utilisateur FROM partage 
                        INNER JOIN utilisateur ON partage.id_utilisateur = utilisateur.id_utilisateur 
                        WHERE partage.id_post = :post_id";
        $stmt_partage = $db->prepare($sql_partage);
        $stmt_partage->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt_partage->execute();
        $emails_partages = $stmt_partage->fetchAll(PDO::FETCH_COLUMN);

        // Afficher le formulaire de modification avec les données du post
        ?>

        <section>
            <div id="content" class="content">
                <form  id="emailForm" action="modifier_post_2.php" method="POST">                
                    <input name="id" type="hidden" value="<?php echo $post_data['id_post']; ?>">
                    <label for="titre">Titre :</label>
                    <input name="titre" type="text" size="25" value="<?php echo $post_titre; ?>">
                    <br><br>
                    <label for="contenu">Contenu :</label>
                    <input name="contenu" type="text" size="25" value="<?php echo $post_contenu; ?>">
                    <br><br>     
                    <label for="couleur">Couleur :</label>
                    <input name="couleur" id="couleur" type="color" size="25" value="<?php echo htmlspecialchars($post_couleur); ?>">
                    <br><br>
                    <label for="police">Choisir une police :</label>
                    <select id="police" name="police">
                        <option value="Arial" <?php if($post_police == 'Arial') echo 'selected'; ?>>Arial</option>
                        <option value="Verdana" <?php if($post_police == 'Verdana') echo 'selected'; ?>>Verdana</option>
                        <option value="Tahoma" <?php if($post_police == 'Tahoma') echo 'selected'; ?>>Tahoma</option>
                        <option value="Courier New" <?php if($post_police == 'Courier New') echo 'selected'; ?>>Courier New</option>
                        <option value="Times New Roman" <?php if($post_police == 'Times New Roman') echo 'selected'; ?>>Times New Roman</option>
                    </select>
                    <br><br>
                    <label for="taille">Choisir une taille :</label>
                    <select id="taille" name="taille">
                        <option value="11" <?php if($post_taille == '11') echo 'selected'; ?>>11</option>
                        <option value="15" <?php if($post_taille == '15') echo 'selected'; ?>>15</option>
                        <option value="20" <?php if($post_taille == '20') echo 'selected'; ?>>20</option>
                        </option>
                    </select>
                    <br><br>

                    <label for="email">Partager avec :</label><br>
                    <div id="emailBubbles">
                        <?php foreach ($emails_partages as $email) { ?>
                            <div class="emailBubble"><?php echo $email; ?><span class="close" onclick="removeEmailBubble(this)">×</span></div>
                        <?php } ?>
                    </div>
                    <input type="hidden" name="emails" id="emails" value="<?php echo implode(',', $emails_partages); ?>">

                    <input type="text" id="email" name="email" minlength="3">
                    <select id="emailList" multiple style="display: none;">
                        <!-- Dropdown options will be populated dynamically -->
                    </select>
                    <div id="notFound" style="display: none;">Utilisateur introuvable</div>
                    <br>                   
                    <input type="submit" value="Modifier" /> 
                </form>
            </div>
        </section>

        <?php
    } else {
        echo "<p>Aucun post trouvé avec cet ID.</p>";
    }
} else {
    echo "<p>Aucun ID de post spécifié.</p>";
}
?>


<script>
$(document).ready(function() {
    // Get references to the color input field and the div
    var colorInput = $('#couleur');
    var contentDiv = $('#content');

    // Function to update background color
    function updateBackgroundColor() {
        var selectedColor = colorInput.val();
        contentDiv.css('background-color', selectedColor);
    }

    // Add event listener for input event on color input field
    colorInput.on('input', function() {
        updateBackgroundColor();
    });

    // Trigger input event manually for color input field to set background color on page load
    updateBackgroundColor();
});
</script>


<script>
$(document).ready(function() {
    // Get references to the select elements
    var selectFontElement = $('#police');
    var selectSizeElement = $('#taille');
    var contentInput = $('input[name="contenu"]')[0];

    // Function to update font family
    function updateFontFamily() {
        var selectedFont = selectFontElement.val();
        contentInput.style.fontFamily = selectedFont;
    }

    // Function to update font size
    function updateFontSize() {
        var selectedSize = selectSizeElement.val();
        contentInput.style.fontSize = selectedSize + 'px';
    }

    // Add event listener for change event on select element for font
    selectFontElement.on('change', function() {
        updateFontFamily();
    });

    // Add event listener for change event on select element for font size
    selectSizeElement.on('change', function() {
        updateFontSize();
    });

    // Trigger change event manually for select elements to set font family and size on page load
    updateFontFamily();
    updateFontSize();
});
</script>



<script>
$(document).ready(function(){
    $('#email').on('input', function() {
        var query = $(this).val();
        if (query.length >= 3) {
            // Fetch emails via AJAX and populate the dropdown
            $.ajax({
                url: 'rechercher_utilisateurs.php',
                type: 'GET',
                data: {query: query},
                dataType: 'json',
                success: function(data) {
                    $('#emailList').empty(); // Clear the dropdown
                    if (data.length > 0) {
                        $('#notFound').hide();
                        $('#emailList').show();
                        $.each(data, function(index, email) {
                            $('#emailList').append('<option value="' + email + '">' + email + '</option>');
                        });
                    } else {
                        $('#emailList').empty().append('<option disabled selected>Utilisateur introuvable</option>').show();
                        $('#notFound').hide();
                    }
                }
            });
        } else {
            $('#emailList').hide(); // Hide the dropdown
            $('#notFound').hide(); // Hide the "Utilisateur introuvable" message
        }
    });

    $('#email').keydown(function(event) {
        if (event.keyCode === 13) { // Check if Enter key is pressed
            event.preventDefault(); // Prevent form submission
        }
    });

    $('#emailList').change(function() {
        var selectedEmail = $(this).val();
        addEmailBubble(selectedEmail); // Add selected email as a bubble
        $(this).val(null).trigger('change'); // Reset the dropdown
    });

// Function to add email as a bubble
function addEmailBubble(email) {
    if (email && email.length > 0) {
        var bubble = $('<div class="emailBubble">' + email + '<span class="close" onclick="removeEmailBubble(this)">×</span></div>');
        $('#emailBubbles').append(bubble);

        // Mettre à jour la valeur du champ caché
        updateHiddenEmails();
    }
}

// Function to remove email bubble
window.removeEmailBubble = function(element) {
    var bubble = $(element).parent();
    bubble.remove();

    // Mettre à jour la valeur du champ caché
    updateHiddenEmails();
};

// Function to update hidden emails input
function updateHiddenEmails() {
    var emails = [];
    $('#emailBubbles .emailBubble').each(function() {
        var email = $(this).text().trim();
        emails.push(email);
    });
    $('#emails').val(emails.join(','));
}


});



</script>
</body>

</html>
