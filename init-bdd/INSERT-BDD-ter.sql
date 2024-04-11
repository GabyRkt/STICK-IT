-- Insertion dans la table `utilisateur`
INSERT INTO utilisateur (username_utilisateur, nom_utlisateur, prenom_utlisateur, email_utlisateur, mdp_utilisateur, date_naissance_utilisateur)
VALUES ('jvinson', 'Vinson', 'Jade', 'jvinson@gmail.com', '12345678', '2000-01-01'),
       ('jdoe', 'Doe', 'John', 'jdoe@outlook.com', '12345678', '1995-05-10'),
       ('gsmith', 'Smith', 'Georges', 'gsmith@parissaclay.com', '12345678', '1988-12-25');

-- Insertion dans la table `post`
INSERT INTO post (titre_post, contenu_post, date_creation_post, date_derniere_modif_post, code_couleur_post, police_post, taille_post, id_utilisateur)
VALUES ('Titre 1', 'Contenu du post 1', '2024-04-11 08:00:00', '2024-04-11 08:00:00', '#FFFFFF', 'Arial', '12pt', 1),
       ('Titre 2', 'Contenu du post 2', '2024-04-11 09:00:00', '2024-04-11 09:00:00', '#FFFF00', 'Verdana', '14pt', 2),
       ('Titre 3', 'Contenu du post 3', '2024-04-11 10:00:00', '2024-04-11 10:00:00', '#00FF00', 'Times New Roman', '16pt', 3);

-- Insertion dans la table `partage` (exemple de partage du post 1 avec l'utilisateur 2)
INSERT INTO partage (id_utilisateur, id_post, id_partage)
VALUES (2, 1, 1);
