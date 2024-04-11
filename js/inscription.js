// fichier de vérifications des champs de la page d'inscription avant validation


document.addEventListener('DOMContentLoaded', function() {

  // Fonction pour afficher une erreur 
  function errorStyle(input, errorMessage) {

    // Trouver l'élément d'erreur correspondant
    const erreur = document.getElementById(input.id + 'Err'); 

    if (erreur) {
      erreur.innerHTML = errorMessage;
      erreur.style.color = "red";

      input.style.backgroundColor = '#FFE8E8'; // Fond rouge clair
      input.style.border = '1px solid red'; // Bordure rouge
    } 

  }

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
  nom.addEventListener('input', function() {
  if (nom.value.trim() !== "") {
    nomErr.innerHTML = "";
  }
  });

  prenom.addEventListener('input', function() {
  if (prenom.value.trim() !== "") {
    prenomErr.innerHTML = "";
  }
  });

  user.addEventListener('input', function() {
  if (user.value.trim() !== "") {
    userErr.innerHTML = "";
  }
  });

  date.addEventListener('input', function() {
  if (date.value.trim() !== "") {
    dateErr.innerHTML = "";
  }
  });

  email.addEventListener('input', function() {
  if (email.value.trim() !== "") {
   emailErr.innerHTML = "";
  }
  });

  email_verif.addEventListener('input', function() {
  if (email_verif.value.trim() !== "") {
   email_verifErr.innerHTML = "";
  }
  });

  mdp.addEventListener('input', function() {
  if (mdp.value.trim() !== "") {
    mdpErr.innerHTML = "";
  }
  });

  mdp_verif.addEventListener('input', function() {
  if (mdp_verif.value.trim() !== "") {
    mdp_verifErr.innerHTML = "";
  }
  });


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
      prenomErr.innerHTML = "Le champ prénom est requis";
      prenomErr.style.color = "red";
      e.preventDefault();
    } 

    // *** Username ***
    if (user.value.trim() === "") {
      userErr.innerHTML = "Le champ nom d'utilisateur est requis";
      userErr.style.color = "red";
      e.preventDefault();
    }

    // *** Date de naissance ***
    let dateFormat = /^\d{4}\/\d{2}\/\d{2}$/;

    if (date.value.trim() === "") {
      dateErr.innerHTML = "Le champ date de naissance est requis";
      dateErr.style.color = "red";
      e.preventDefault();
    } else { 

     //Verifier que la date de naissance soit bien dans le format AAAA/MM/JJ
      if (!date.value.match(dateFormat)) {
      dateErr.innerHTML = "Veuillez saisir une date de naissance valide (AAAA/MM/JJ)";
      dateErr.style.color = "red";
      e.preventDefault(); // Empêche la soumission du formulaire
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
      email_verifErr.innerHTML = "Les adresses email ne correspondent pas";
      email_verifErr.style.color = "red";
      e.preventDefault(); // Empêche la soumission du formulaire
    }

    // *** Mot de passe ***
    if (mdp.value.trim() === "") {
      mdpErr.innerHTML = "Le champ mot de passe est requis";
      mdpErr.style.color = "red";
      e.preventDefault();
    } else {

      //Verifier que la mot de passe est au moins 6 caracteres
      if (mdp.value.trim().length < 6) {
        mdpErr.innerHTML = "Le mot de passe doit avoir au moins 6 caractères";
        mdpErr.style.color = "red";
        e.preventDefault();
      }
    }



    // *** Confirmation Mot de passe ***
    if (mdp_verif.value.trim() === "") {
      mdp_verifErr.innerHTML = "Le champ confirmation mot de passe est requis";
      mdp_verifErr.style.color = "red";
      e.preventDefault();
    }

    //Verifier que le "confirmer mot de passe" est le meme que le mot de passe
    if (mdp_verif.value !== mdp.value) {
      mdp_verifErr.innerHTML = "Les mots de passe ne correspondent pas";
      mdp_verifErr.style.color = "red";
      e.preventDefault();
    }

  });
});
