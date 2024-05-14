// fichier de vérifications des champs de la page deconnexion avant validation
document.addEventListener('DOMContentLoaded', function() {

    //Declaration des variables
    let formu_co = document.getElementById("connexion");
    let email = document.getElementById("email");
    let emailErr = document.getElementById("emailErr");
    let mdp = document.getElementById("mdp");
    let mdpErr = document.getElementById("mdpErr");


    //Effacer le message erreur "Le champs [...] est requis" une fois qu'on écrit
    function champVide(element, elementErr) {
        element.addEventListener('input', function() {
        if (element.value.trim() !== "") {
            elementErr.innerHTML = "";
            element.style.backgroundColor = '#ffffff';
            element.style.border = '1px solid black'; 
        }
        })
    }

    champVide(email, emailErr);
    champVide(mdp, mdpErr);

   // Fonction pour afficher une erreur 
    function errorStyle(element, errorMessage) {

        // Trouver l'élément d'erreur correspondant
        let erreur = document.getElementById(element.id + 'Err'); 

        if (erreur) {
        erreur.innerHTML = errorMessage;
        erreur.style.color = "red";

        element.style.backgroundColor = '#FFE8E8'; // Fond rouge clair
        element.style.border = '1px solid red'; // Bordure rouge
        } 

    }
    
    //Validation du formulaire
    formulaire.addEventListener('submit', function(e) {
        //Vérification que tous les champs sont remplis
        
        // *** Email ***
        if (email.value.trim() === "") {
            errorStyle(email, "Le champ email est requis");
            e.preventDefault();
        }

        // *** Mot de passe ***
        if (mdp.value.trim() === "") {
            errorStyle(mdp, "Le champ mot de passe est requis");
            e.preventDefault();
    
        }

    });
});
