document.addEventListener('DOMContentLoaded', function() {
    fetch('php/accueil.php')
    .then(response => response.json())
    .then(posts => {
        const postContainer = document.getElementById('ownedPostIts'); // Utilisez 'ownedPostIts' ou un autre conteneur approprié

        posts.forEach(post => {
            postContainer.innerHTML += `
                <div class="sticky-note" style="background-color: ${post.code_couleur_post}; font-family: ${post.police_post}; font-size: ${post.taille_post};">
                    <div class="note-title"><a class="title-link" href="#" style="text-decoration:none">${post.titre_post}</a></div>
                    <div class="note-content">${post.contenu_post}</div>
                    <div class="note-date">${post.date_creation_post}</div>
                    <div class="note-modified">${post.date_derniere_modif_post}</div>
                </div>
            `;
        });
    })
    .catch(error => console.error('Error:', error));
});
