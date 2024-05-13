document.addEventListener('DOMContentLoaded', function() {
    fetch('../php/accueil_2.php')
    .then(response => response.json())
    .then(data => {
        const ownedContainer = document.getElementById('ownedPostIts');
        const sharedContainer = document.getElementById('sharedPostIts');

        // Affichage des post-its possédés
        data.ownedPosts.forEach(post => {
            ownedContainer.innerHTML += `
                <div class="sticky-note" style="background-color: ${post.code_couleur_post};">
                    <div class="note-title"><a class="title-link" href="../afficher_post.php?id=${post.id_post}" style="text-decoration:none">${post.titre_post}</a></div>
                    <div class="note-date">${post.date_creation_post}</div>
                    <a class="button" href="../php/modifier_post.php?id=${post.id_post}" style="text-decoration:none;">Modifier</a>
                    <a class="button" href="../php/supprimer_post.php?id=${post.id_post}" style="text-decoration:none;">Supprimer</a>

                </div>
            `;
        });

        // Affichage des post-its partagés
        data.sharedPosts.forEach(post => {
            sharedContainer.innerHTML += `
                <div class="sticky-note" style="background-color: ${post.code_couleur_post};">
                    <div class="note-title"><a class="title-link" href="../afficher_post.php?id=${post.id_post}" style="text-decoration:none">${post.titre_post}</a></div>
                    <div class="note-date">${post.date_creation_post}</div>
                    <div class="note-user"><p>crée par ${post.username_utilisateur}</p></div>
                </div>
            `;
        });
    })
    .catch(error => console.error('Error:', error));
});
