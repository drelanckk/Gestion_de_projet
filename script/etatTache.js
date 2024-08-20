//form etat
let formEtat = document.getElementById("formEtat")
let modalEtat = document.getElementById('modalEtat')
let valTache = document.getElementById('valTache')
var span = document.querySelector(".close2")

let id_tache = 0
let mesBouton = document.querySelectorAll('#mesTaches button')


span.onclick = function () {
    modalEtat.style.display = 'none';
}

document.querySelectorAll('.dropdown-button').forEach(button => {
    button.addEventListener('click', function(event) {
        // Fermer tous les autres dropdowns ouverts
        document.querySelectorAll('.dropdown-content').forEach(content => {
            content.classList.remove('show');
        });

        // Récupérer le dropdown-content associé et le basculer
        const dropdownContent = this.nextElementSibling;
        dropdownContent.classList.toggle('show');
    });
});

// Fermer le menu si l'utilisateur clique en dehors de celui-ci
window.addEventListener('click', (event) => {
    if (!event.target.matches('.dropdown-button') && !event.target.closest('.dropdown-content')) {
        document.querySelectorAll('.dropdown-content').forEach(content => {
            content.classList.remove('show');
        });
    }
});

formEtat.addEventListener('submit', event => {
    // event.preventDefault();

    const formData = new FormData(formEtat);
    console.log('test')

    console.log(id_tache)

    formData.append('id_tache', id_tache);
    fetch('etatTache.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // console.log(test)
                console.log(data)
                valTache.innerHTML = `${data.valeur}`
                modalEtat.style.display = 'none';

            } else {
                console.log("erreurrrr !")
            }

        })
        .catch(error => {
            console.log('erreur :', error)
        })

})


// Sélection du bouton et du menu déroulant
// const dropdownButton = document.querySelector('.dropdown-button');
// const dropdownContent = document.querySelector('.dropdown-content');

// // Ajout de l'événement de clic sur le bouton
// dropdownButton.addEventListener('click', () => {
//     // Bascule l'affichage du menu déroulant
//     console.log("test")
//     dropdownContent.classList.toggle('show');
// });