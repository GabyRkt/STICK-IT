// fichier de vérifications des champs de la page d'inscription avant validation
document.addEventListener('DOMContentLoaded', function() {

  //Declaration des variables
  let formulaire = document.getElementById("formulaire");

  let nomErr = document.getElementById("nomErr");
  let nom = document.getElementById("nom");

  let prenom = document.getElementById("prenom");
  let prenomErr = document.getElementById("prenomErr");

  let username = document.getElementById("username");
  let userErr = document.getElementById("userErr");

  let date_naissance = document.getElementById("date_naissance");
  let dateErr = document.getElementById("dateErr");

  let email = document.getElementById("email");
  let emailErr = document.getElementById("emailErr");

  let email_verif = document.getElementById("email_verif");
  let emailvErr = document.getElementById("emailvErr");


  let mdp = document.getElementById("mdp");
  let passwErr = document.getElementById("passwErr");

  let mdp_verif = document.getElementById("mdp_verif");
  let passwveErr = document.getElementById("passwveErr");

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

  username.addEventListener('input', function() {
  if (username.value.trim() !== "") {
  userErr.innerHTML = "";
  }
  });

  date_naissance.addEventListener('input', function() {
  if (date_naissance.value.trim() !== "") {
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
  emailvErr.innerHTML = "";
  }
  });

  mdp.addEventListener('input', function() {
  if (mdp.value.trim() !== "") {
  passwErr.innerHTML = "";
  }
  });

  mdp_verif.addEventListener('input', function() {
  if (mdp_verif.value.trim() !== "") {
  passwveErr.innerHTML = "";
  }
  });

//Validation du formulaire
  formulaire.addEventListener('submit', function(e) {
    //Vérification que tous les champs sont remplis
    //Nom
    if (nom.value.trim() === "") {
      nomErr.innerHTML = "Le champ nom est requis";
      nomErr.style.color = "red";
      e.preventDefault();
    }

    //Prénom
    if (prenom.value.trim() === "") {
      prenomErr.innerHTML = "Le champ prénom est requis";
      prenomErr.style.color = "red";
      e.preventDefault();
    }

    //Username
    if (username.value.trim() === "") {
      userErr.innerHTML = "Le champ nom d'utilisateur est requis";
      userErr.style.color = "red";
      e.preventDefault();
    }

    //Date de naissance
    if (date_naissance.value.trim() === "") {
      dateErr.innerHTML = "Le champ date de naissance est requis";
      dateErr.style.color = "red";
      e.preventDefault();
    }

    //Email
    if (email.value.trim() === "") {
      emailErr.innerHTML = "Le champ email est requis";
      emailErr.style.color = "red";
      e.preventDefault();
    }

    //Confirmation Email
    if (email_verif.value.trim() === "") {
      emailvErr.innerHTML = "Le champ confirmation email est requis";
      emailvErr.style.color = "red";
      e.preventDefault();
    }

    //Mot de passe
    if (mdp.value.trim() === "") {
      passwErr.innerHTML = "Le champ mot de passe est requis";
      passwErr.style.color = "red";
      e.preventDefault();
    }

    //Confirmation Mot de passe
    if (mdp_verif.value.trim() === "") {
      passwveErr.innerHTML = "Le champ confirmation mot de passe est requis";
      passwveErr.style.color = "red";
      e.preventDefault();
    }

    //Verifier que la mot de passe est au moins 6 caracteres
    if (mdp.value.trim().length < 6) {
      passwErr.innerHTML = "Le mot de passe doit avoir au moins 6 caractères";
      passwErr.style.color = "red";
      e.preventDefault();
    }

    //Verifier que le "confirmer mot de passe" est le meme que le mot de passe
    if (mdp_verif.value !== mdp.value) {
      passwveErr.innerHTML = "Les mots de passe ne correspondent pas";
      passwveErr.style.color = "red";
      e.preventDefault();
    }

    //Verifier que l'email soit bien sur le format login@domaine.extension
    let emailFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.match(emailFormat)) {
      emailErr.innerHTML = "Veuillez saisir un email valide";
      emailErr.style.color = "red";
      e.preventDefault(); // Empêche la soumission du formulaire
    }
    //Verifier que le "confirmer email" soit le meme que l'email
    if (email_verif.value !== email.value) {
     emailvErr.innerHTML = "Les adresses email ne correspondent pas";
     emailvErr.style.color = "red";
     e.preventDefault(); // Empêche la soumission du formulaire
   }

   //Verifier que la date de naissance soit bien dans le format AAAA/MM/JJ
   let dateFormat = /^\d{8}$/;
    if (!date_naissance.value.match(dateFormat)) {
      dateErr.innerHTML = "Veuillez saisir une date de naissance valide (AAAA/MM/JJ)";
      dateErr.style.color = "red";
      e.preventDefault(); // Empêche la soumission du formulaire
    }

  });
});
