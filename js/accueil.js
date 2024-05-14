document.addEventListener('DOMContentLoaded', function() {
    fetch('../php/accueil_2.php')
    .then(response => response.json())
    .then(data => {
        const ownedContainer = document.getElementById('ownedPostIts');
        const sharedContainer = document.getElementById('sharedPostIts');
        const dateFormatter = new Intl.DateTimeFormat('fr-FR', {
            year: '2-digit',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            hour12: false // Utilisation du format 24 heures
        });

        // Fonction pour formater la date
        function formatPostItDate(dateString) {
            const date = new Date(dateString);
            return dateFormatter.format(date);
        }

        // Affichage des post-its possédés
        data.ownedPosts.forEach(post => {
            ownedContainer.innerHTML += `
                <div class="sticky-note" style="background-color: ${post.code_couleur_post};">
                    <div class="note-title">
                        <a class="title-link" href="../afficher_post.php?id=${post.id_post}" style="text-decoration:none">${post.titre_post}</a>
                    </div><br />
                    <BR>
                    <div class="note-info">
                        <a class="note-date">${formatPostItDate(post.date_creation_post)}</a>
                        <div class="note-button">
                            <a class="button" href="../php/modifier_post.php?id=${post.id_post}" style="text-decoration:none;"><img src="../icons/pencil-square.svg"</a>
                            <a class="button" href="../php/supprimer_post.php?id=${post.id_post}" style="text-decoration:none;"><img src="../icons/trash-fill.svg"</a>
                        </div>
                    </div>
                </div>
            `;
        });

        // Affichage des post-its partagés
        data.sharedPosts.forEach(post => {
            sharedContainer.innerHTML += `
                <div class="sticky-note" style="background-color: ${post.code_couleur_post};">
                    <div class="note-title">
                        <a class="title-link" href="../afficher_post.php?id=${post.id_post}" style="text-decoration:none">${post.titre_post}</a>
                    </div><br />
                    <BR>
                    <div class="note-info">
                        <div class="note-date">${formatPostItDate(post.date_creation_post)}</div>
                        <div class="note-user">
                            <div>
                                <em>crée par ${post.username_utilisateur}</em>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
    })
    .catch(error => console.error('Error:', error));
});
