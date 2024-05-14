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
      erreur.style.fontSize = "12px";

      element.style.backgroundColor = '#FFE8E8'; // Fond rouge clair
      element.style.border = '1px solid red'; // Bordure rouge

    } 

  }


  // Fonctions de validation des champs
  function validerNom() {
      if (nom.value.trim() === "") {
          errorStyle(nom, "Le champ nom est requis");
          return false;
      }
      return true;
  }

  function validerPrenom() {
      if (prenom.value.trim() === "") {
          errorStyle(prenom, "Le champ prénom est requis");
          return false;
      }
      return true;
  }

  function validerUser() {
      if (user.value.trim() === "") {
          errorStyle(user, "Le champ nom d'utilisateur est requis");
          return false;
      }
      return true;
  }

  function validerDate() {
      let dateFormat = /^\d{4}\/\d{2}\/\d{2}$/;
      if (date.value.trim() === "") {
          errorStyle(date, "Le champ date de naissance est requis");
          return false;

      } else if (!date.value.match(dateFormat)) {
          errorStyle(date, "Veuillez saisir une date de naissance valide (AAAA/MM/JJ)");
          return false;
      }

      return true;
  }

  function validerEmail() {
      let emailFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (email.value.trim() === "") {
          errorStyle(email, "Le champ email est requis");
          return false;
      } else if (!email.value.match(emailFormat)) {
          errorStyle(email, "Veuillez saisir un email valide");
          return false;
      }
      return true;
  }

  function validerEmailVerif() {
      if (email_verif.value.trim() === "") {
          errorStyle(email_verif, "Le champ confirmation email est requis");
          return false;
      } else if (email_verif.value !== email.value) {
          errorStyle(email_verif, "Les adresses email ne correspondent pas");
          return false;
      }
      return true;
  }

  function validerMdp() {
      if (mdp.value.trim() === "") {
          errorStyle(mdp, "Le champ mot de passe est requis");
          return false;
      } else if (mdp.value.trim().length < 6) {
          errorStyle(mdp, "Le mot de passe doit avoir au moins 6 caractères");
          return false;
      }

      return true;
  }

  function validerMdpVerif() {
      if (mdp_verif.value.trim() === "") {
          errorStyle(mdp_verif, "Le champ confirmation mot de passe est requis");
          return false;

      } else if (mdp_verif.value !== mdp.value) {
          errorStyle(mdp_verif, "Les mots de passe ne correspondent pas");
          return false;
      }

      return true;
  }


  // Validation du formulaire 
  formulaire.addEventListener('submit', function(e) {
      e.preventDefault();

      // Validation dynamique
      nom.addEventListener('input', validerNom);
      prenom.addEventListener('input', validerPrenom);
      user.addEventListener('input', validerUser);
      date.addEventListener('input', validerDate);
      email.addEventListener('input', validerEmail);
      email_verif.addEventListener('input', validerEmailVerif);
      mdp.addEventListener('input', validerMdp);
      mdp_verif.addEventListener('input', validerMdpVerif);
      
     // Vérification lors de la validation
      if (!validerNom() ) {
          e.preventDefault();
      }
      if (!validerPrenom() ) {
          e.preventDefault();
      }
      if (!validerUser() ) {
          e.preventDefault();
      }
      if (!validerDate()) {
          e.preventDefault();
      }
      if (!validerEmail() ) {
          e.preventDefault();
      }
      if (!validerEmailVerif()) {
          e.preventDefault();
      }
      if (!validerMdp()) {
          e.preventDefault();
      }
      if (!validerMdpVerif()) {
          e.preventDefault();
      }
  });

});
