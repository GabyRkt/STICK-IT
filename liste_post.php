<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style/ListePost.css" type="text/css" />
    <title>Liste post</title>
</head>

<body>

    <?php include 'database/db_co.php'; ?>
    <br>
    <h2>Listes des post</h2>
    <br>
    <table border="1" width="100%">
        <tr>
            <th>Titre</th>
            <th>Contenu</th>
        </tr>
        <?php
        // Écriture de la requête
        $sql = "SELECT * FROM post";
        // Envoi de la requête
        $stmt = $db->prepare($sql);
        $stmt->execute();

        // Vérifie le nombre de lignes retournées
        if ($stmt->rowCount() > 0) {
            // Lecture des enregistrements ligne par ligne
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                // Rendre le titre cliquable avec un lien vers modifier.php avec l'ID du post
                echo "<td><a href='afficher_post.php?id=".$row['id_post']."'>".$row['titre_post']."</a>
                <a href='modifier_post.php?id=".$row['id_post']."'>Modifier</a>
                <a href='supprimer_post.php?id=".$row['id_post']."'>Supprimer</a></td>";
                echo "<td>".$row['contenu_post']."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Aucun post trouvé</td></tr>";
        }
        ?>
    </table>

</body>

</html>
