<?php
// fichier de connexion à la base de données post-it
$user = 'root';
$password = '';

try {
  $db = new PDO ('mysql:host=localhost;dbname=ter',$user,$password);
} catch (PDOException $e) {
  print "Erreur : " . $e->getMessage() . "<br/>";
  die;
}
 ?>
