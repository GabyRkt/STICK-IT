// fichier de vérifications des champs de la page d'inscription avant validation


document.addEventListener('DOMContentLoaded', function() {

  //Declaration des variables
  let formulaire = document.getElementById("formulaire");

  let nomErr = document.getElementById("nomErr");
  let nom = document.getElementById("nom");

  let prenom = document.getElementById("prenom");
  let prenomErr = document.getElementById("prenomErr");

  let user = document.getElementById("user");
  let userErr = document.getElementById("userErr");

  let date = document.getElementById("date");
  let dateErr = document.getElementById("dateErr");

  let email = document.getElementById("email");
  let emailErr = document.getElementById("emailErr");

  let email_verif = document.getElementById("email_verif");
  let email_verifErr = document.getElementById("email_verifErr");

  let mdp = document.getElementById("mdp");
  let mdpErr = document.getElementById("mdpErr");

  let mdp_verif = document.getElementById("mdp_verif");
  let mdp_verifErr = document.getElementById("mdp_verifErr");

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

  champVide(nom, nomErr);
  champVide(prenom, prenomErr);
  champVide(user, userErr);
  champVide(date, dateErr);
  champVide(email, emailErr);
  champVide(email_verif, email_verifErr);
  champVide(mdp, mdpErr);
  champVide(mdp_verif, mdp_verifErr);

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

    // *** Nom ***
    if (nom.value.trim() === "") {
      errorStyle(nom, "Le champ nom est requis");
      e.preventDefault();
    }

    // *** Prénom ***
    if (prenom.value.trim() === "") {
      errorStyle(prenom,"Le champ prénom est requis");
      e.preventDefault();
    } 

    // *** Username ***
    if (user.value.trim() === "") {
      errorStyle(user, "Le champ nom d'utilisateur est requis");
      e.preventDefault();
    }

    // *** Date de naissance ***
    let dateFormat = /^\d{4}\/\d{2}\/\d{2}$/;

    if (date.value.trim() === "") {
      errorStyle(date, "Le champ date de naissance est requis");
      e.preventDefault();
    } else { 

     //Verifier que la date de naissance soit bien dans le format AAAA/MM/JJ
      if (!date.value.match(dateFormat)) {
          errorStyle(date,"Veuillez saisir une date de naissance valide (AAAA/MM/JJ)");
          e.preventDefault(); 
      }
    }


    // *** Email ***
    let emailFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email.value.trim() === "") {
      errorStyle(email, "Le champ email est requis");
      e.preventDefault();
    } else {

      //Verifier que l'email soit bien sur le format login@domaine.extension
      if (!email.value.match(emailFormat)) {
        errorStyle(email, "Veuillez saisir un email valide");
        e.preventDefault(); // Empêche la soumission du formulaire
      }
    }

    // *** Confirmation Email ***
    if (email_verif.value.trim() === "") {
      errorStyle(email_verif, "Le champ confirmation email est requis");
      e.preventDefault();
    }

    //Verifier que le "confirmer email" soit le meme que l'email
    if (email_verif.value !== email.value) {
      errorStyle(email_verif, "Les adresses email ne correspondent pas");
      e.preventDefault(); // Empêche la soumission du formulaire
    }

    // *** Mot de passe ***
    if (mdp.value.trim() === "") {
      errorStyle(mdp, "Le champ mot de passe est requis");
      e.preventDefault();

    } else {

      //Verifier que la mot de passe est au moins 6 caracteres
      if (mdp.value.trim().length < 6) {
          errorStyle(mdp, "Le mot de passe doit avoir au moins 6 caractères");
          e.preventDefault();
      }
    }


    // *** Confirmation Mot de passe ***
    if (mdp_verif.value.trim() === "") {
      errorStyle(mdp_verif, "Le champ confirmation mot de passe est requis");
      e.preventDefault();
    }

    //Verifier que le "confirmer mot de passe" est le meme que le mot de passe
    if (mdp_verif.value !== mdp.value) {
      errorStyle(mdp_verif, "Les mots de passe ne correspondent pas");
      e.preventDefault();
    }

  });
});
