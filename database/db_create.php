<?php
// fichier de création de la base de données 

// connexion à phpMyAdmin

$user = 'root';
$password = '';

try {
  $db = new PDO ('mysql:host=localhost',$user,$password);
} catch (PDOException $e) {
  print "Erreur : " . $e->getMessage() . "<br/>";
  die;
}



//création de la base de données post-it
try {
  $sql_db = "CREATE DATABASE IF NOT EXISTS `ter`";
  $db->exec($sql_db);
  echo "Base de données créée <br>";
} catch (PDOException $e) {
  echo "Erreur de création de la base de données : " . $e->getMessage() . "<br>";
}

$db = null;
?>


<?php
// fichier de création des tables

// connexion à phpMyAdmin
include 'db_co.php';

//création des tables
try {
  $sql_utilisateur = "CREATE TABLE IF NOT EXISTS Utilisateur(
    id_utilisateur INT AUTO_INCREMENT,
    username_utilisateur VARCHAR(50),
    nom_utilisateur VARCHAR(50),
    prenom_utilisateur VARCHAR(50),
    email_utilisateur VARCHAR(50),
    mdp_utilisateur VARCHAR(2000),
    date_naissance_utilisateur DATE,
    PRIMARY KEY(id_utilisateur)
    )";
  $db->exec($sql_utilisateur);
  echo "Table utilisateur créée <br>";
} catch (PDOException $e) {
  echo "Erreur de création de la table utilisateur : " . $e->getMessage() . "<br>";
}

try {
  $sql_post = "CREATE TABLE IF NOT EXISTS Post(
    id_post INT AUTO_INCREMENT,
    titre_post VARCHAR(150),
    contenu_post TEXT,
    date_creation_post DATETIME,
    date_derniere_modif_post DATETIME,
    code_couleur_post VARCHAR(10),
    police_post VARCHAR(50),
    taille_post VARCHAR(50),
    id_utilisateur INT NOT NULL,
    PRIMARY KEY(id_post),
    FOREIGN KEY(id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
    )";
  $db->exec($sql_post);
  echo "Table post créée <br>";
} catch (PDOException $e) {
  echo "Erreur de création de la table post : " . $e->getMessage() . "<br>";
}

try {
  $sql_partage = "CREATE TABLE IF NOT EXISTS Partage(
    id_utilisateur INT,
    id_post INT,
    id_partage INT AUTO_INCREMENT,
    PRIMARY KEY(id_partage),
    UNIQUE(id_utilisateur, id_post),
    FOREIGN KEY(id_utilisateur) REFERENCES Utilisateur(id_utilisateur),
    FOREIGN KEY(id_post) REFERENCES Post(id_post)
    )";
  $db->exec($sql_partage);
  echo "Table partage créée <br>";
} catch (PDOException $e) {
  echo "Erreur de création de la table partage : " . $e->getMessage() . "<br>";
}

//fermeture de la connexion
$db = null;
?>

