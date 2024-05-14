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

    // Ajouter un écouteur d'événements pour l'événement input sur le champ de saisie de couleur
    colorInput.on('input', function() {
        updateBackgroundColor();
    });

    // Déclencher manuellement l'événement input pour le champ de saisie de couleur afin de définir la couleur d'arrière-plan au chargement de la page
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

    // Ajouter un écouteur d'événements pour l'événement change sur l'élément select de la police
    selectFontElement.on('change', function() {
        updateFontFamily();
    });

    // Ajouter un écouteur d'événements pour l'événement change sur l'élément select de la taille de la police
    selectSizeElement.on('change', function() {
        updateFontSize();
    });

    // Déclencher manuellement l'événement change pour les éléments select afin de définir la police et la taille au chargement de la page
    updateFontFamily();
    updateFontSize();
});

// Recherche d'utilisateurs via AJAX
$(document).ready(function() {
    // Ajouter un écouteur d'événements pour l'événement input sur le champ email
    $('#email').on('input', function() {
        var query = $(this).val();
        if (query.length >= 3) {
            // Récupérer les emails via AJAX et remplir le champ de sélection déroulante
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
            $('#emailList').hide(); // Masquer le champ de sélection déroulante
            $('#notFound').hide(); // Masquer le message "Utilisateur introuvable"
        }
    });

    // Ajouter un écouteur d'événements pour l'événement keydown sur le champ email
    $('#email').keydown(function(event) {
        if (event.keyCode === 13) { // Vérifier si la touche Entrée est enfoncée
            event.preventDefault(); // Empêcher la soumission du formulaire
        }
    });

    // Ajouter un écouteur d'événements pour l'événement change sur le champ de sélection déroulante email
    $('#emailList').change(function() {
        var selectedEmail = $(this).val();
        addEmailBubble(selectedEmail); // Ajouter l'email sélectionné sous forme de bulle
        $(this).val(null).trigger('change'); // Réinitialiser le champ de sélection déroulante
    });

    // Fonction pour ajouter un email sous forme de bulle
    function addEmailBubble(email) {
        if (email && email.length > 0) {
            var bubble = $('<div class="emailBubble">' + email + '<span class="close" onclick="removeEmailBubble(this)">×</span></div>');
            $('#emailBubbles').append(bubble);

            // Mettre à jour la valeur du champ caché
            updateHiddenEmails();
        }
    }

    // Fonction pour supprimer une bulle d'email
    window.removeEmailBubble = function(element) {
        var bubble = $(element).parent();
        bubble.remove();

        // Mettre à jour la valeur du champ caché
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
        let isValid = true; // Initialiser la variable isValid à true

        // Vérifier si le champ "titre" est vide
        if ($('#titre').val().trim() === '') {
            $('#titre').addClass('error'); // Ajouter la classe d'erreur au champ "titre"
            $('#titreErr').text('Le titre est obligatoire.'); // Afficher un message d'erreur
            isValid = false; // Mettre isValid à false car le champ est vide
        } else {
            $('#titre').removeClass('error'); // Supprimer la classe d'erreur du champ "titre"
            $('#titreErr').text(''); // Effacer le message d'erreur
        }

        // Vérifier si le champ "contenu" est vide
        if ($('#contenu').val().trim() === '') {
            $('#contenu').addClass('error'); // Ajouter la classe d'erreur au champ "contenu"
            $('#contenuErr').text('Le contenu est obligatoire.'); // Afficher un message d'erreur
            isValid = false; // Mettre isValid à false car le champ est vide
        } else {
            $('#contenu').removeClass('error'); // Supprimer la classe d'erreur du champ "contenu"
            $('#contenuErr').text(''); // Effacer le message d'erreur
        }

        return isValid; // Retourner la validité du formulaire (true ou false)
    }

    // Ajouter un écouteur d'événements sur la soumission du formulaire
    $('#modifyForm').on('submit', function(e) {
        if (!validateForm()) { // Si le formulaire n'est pas valide
            e.preventDefault(); // Empêcher la soumission du formulaire
        }
    });

    // Ajouter un écouteur d'événements sur les champs "titre" et "contenu" pour vérifier en temps réel
    $('#titre, #contenu').on('input', function() {
        validateForm(); // Appeler la fonction de validation à chaque saisie
    });

    validateForm(); // Appeler la fonction de validation initialement pour vérifier si les champs sont vides dès le chargement de la page
});
