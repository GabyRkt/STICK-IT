// Mise à jour de la couleur d'arrière-plan
$(document).ready(function() {
    // Récupérer les références au champ de saisie de couleur et à la div
    var colorInput = $('#couleur');
    var contentDiv = $('#content');

    // Fonction pour mettre à jour la couleur d'arrière-plan
    function updateBackgroundColor() {
        var selectedColor = colorInput.val();
        contentDiv.css('background-color', selectedColor);
    }
    
    colorInput.on('input', function() {
        updateBackgroundColor();
    });

    // Déclenche le input pour le champ de saisie de couleur afin de définir la couleur d'arrière-plan au chargement de la page
    updateBackgroundColor();
});

// Mise à jour de la police de caractères et de la taille
$(document).ready(function() {
    // Récupérer les références aux éléments select
    var selectFontElement = $('#police');
    var selectSizeElement = $('#taille');
    var contentInput = $('textarea[name="contenu"]')[0];

    // Fonction pour mettre à jour la police de caractères
    function updateFontFamily() {
        var selectedFont = selectFontElement.val();
        contentInput.style.fontFamily = selectedFont;
    }

    // Fonction pour mettre à jour la taille de la police
    function updateFontSize() {
        var selectedSize = selectSizeElement.val();
        contentInput.style.fontSize = selectedSize + 'px';
    }

    selectFontElement.on('change', function() {
        updateFontFamily();
    });

    selectSizeElement.on('change', function() {
        updateFontSize();
    });

    updateFontFamily();
    updateFontSize();
});

// Recherche d'utilisateurs via AJAX
$(document).ready(function() {
    $('#email').on('input', function() {
        var query = $(this).val();
        if (query.length >= 3) {
            // Récupérer les emails via AJAX et remplir la liste déroulante
            $.ajax({
                url: 'rechercher_utilisateurs.php',
                type: 'GET',
                data: {query: query},
                dataType: 'json',
                success: function(data) {
                    $('#emailList').empty(); // Vider le champ de sélection déroulante
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
            $('#emailList').hide(); 
            $('#notFound').hide(); 
        }
    });

    $('#email').keydown(function(event) {
        if (event.keyCode === 13) { 
            event.preventDefault(); // Empêcher la soumission du formulaire
        }
    });

    $('#emailList').change(function() {
        var selectedEmail = $(this).val();
        addEmailBubble(selectedEmail); // Ajout de l'email sélectionné sous forme de bulle
        $(this).val(null).trigger('change'); // Réinitialise le champ de sélection déroulante
    });

    // Fonction pour ajouter un email sous forme de bulle
    function addEmailBubble(email) {
        if (email && email.length > 0) {
            var bubble = $('<div class="emailBubble">' + email + '<span class="close" onclick="removeEmailBubble(this)">×</span></div>');
            $('#emailBubbles').append(bubble);
            updateHiddenEmails();
        }
    }

    // Fonction pour supprimer une bulle d'email
    window.removeEmailBubble = function(element) {
        var bubble = $(element).parent();
        bubble.remove();
        updateHiddenEmails();
    };

    // Fonction pour mettre à jour le champ caché contenant les emails
    function updateHiddenEmails() {
        var emails = [];
        $('#emailBubbles .emailBubble').each(function() {
            var email = $(this).text().trim();
            emails.push(email);
        });
        $('#emails').val(emails.join(','));
    }
});

// Fonction pour valider le formulaire
$(document).ready(function() {
    function validateForm() {
        let isValid = true; 

        // Vérifier si le champ "titre" est vide
        if ($('#titre').val().trim() === '') {
            $('#titre').addClass('error'); 
            $('#titreErr').text('Le titre est obligatoire.'); 
            isValid = false; 
        } else {
            // Vérifier si le titre est plus long que 150 caractères
            if ($('#titre').val().trim().length > 150) {
                $('#titre').addClass('error'); 
                $('#titreErr').text('Le titre est trop long (maximum 150 caractères).'); 
                isValid = false; 
            } else {
                $('#titre').removeClass('error');
                $('#titreErr').text('');
            }
        }

        // Vérifier si le champ "contenu" est vide
        if ($('#contenu').val().trim() === '') {
            $('#contenu').addClass('error'); 
            $('#contenuErr').text('Le contenu est obligatoire.'); 
            isValid = false; 
        } else {
            $('#contenu').removeClass('error'); 
            $('#contenuErr').text(''); 
        }

        return isValid; 
    }

    $('#modifyForm').on('submit', function(e) {
        if (!validateForm()) { // Si le formulaire n'est pas valide
            e.preventDefault(); // Empeche la soumission 
        }
    });

    $('#titre, #contenu').on('input', function() {
        validateForm(); 
    });
    validateForm();
});

//Ne valide pas le formulaire si le titre est trop long
function checkTitleLength() {
    var titre = document.getElementById('titre').value;
    var titreErr = document.getElementById('titreErr');
    if (titre.length > 150) {
        titreErr.textContent = "Le titre ne peut pas dépasser 150 caractères.";
        titreErr.style.display = "block";
        document.getElementById('titre').style.borderColor = "red";
        return false;
    } else {
        titreErr.textContent = "";
        titreErr.style.display = "none";
        document.getElementById('titre').style.borderColor = "";
        return true;
    }
}
