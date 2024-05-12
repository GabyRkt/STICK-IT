document.addEventListener('DOMContentLoaded', function() {
    fetch('php/accueil.php')
    .then(response => response.json())
    .then(data => {
        const ownedContainer = document.getElementById('ownedPostIts');
        const sharedContainer = document.getElementById('sharedPostIts');

        // Affichage des post-its possédés
        data.ownedPosts.forEach(post => {
            ownedContainer.innerHTML += `
                <div class="sticky-note" style="background-color: ${post.code_couleur_post}; font-family: ${post.police_post}; font-size: ${post.taille_post};">
                    <div class="note-title"><a class="title-link" href="../afficher_post.php" style="text-decoration:none">${post.titre_post}</a></div>
                    <div class="note-date">${post.date_creation_post}</div>
                    <button href="#"> Modifier </button>
                    <button href="#"> Supprimer </button>

                </div>
            `;
        });

        // Affichage des post-its partagés
        data.sharedPosts.forEach(post => {
            sharedContainer.innerHTML += `
                <div class="sticky-note" style="background-color: ${post.code_couleur_post}; font-family: ${post.police_post}; font-size: ${post.taille_post};">
                    <div class="note-title"><a class="title-link" href="#" style="text-decoration:none">${post.titre_post}</a></div>
                    <div class="note-date">${post.date_creation_post}</div>
                </div>
            `;
        });
    })
    .catch(error => console.error('Error:', error));
});
