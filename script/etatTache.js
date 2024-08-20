//form etat
let formEtat = document.getElementById("formEtat")
let modalEtat = document.getElementById('modalEtat')
let valTache = document.getElementById('valTache')
var span = document.querySelector(".close2")



document.querySelectorAll('.dropdown-button').forEach(button => {
    button.addEventListener('click', function (eventBtn) {
        // Fermer tous les autres dropdowns ouverts
        document.querySelectorAll('.dropdown-content').forEach(content => {
            content.classList.remove('show');
        });

        //id tache
        let id_tache = this.id
        console.log(id_tache, "id tache")

        //contenue du bouton
        let btnChoix = this.textContent
        console.log(btnChoix, "contenu bouton")

        // Récupérer le dropdown-content associé et le basculer
        const dropdownContent = this.nextElementSibling;

        console.log(dropdownContent)
        dropdownContent.classList.toggle('show');

        dropdownContent.addEventListener('click', (action) => {

            //choix du nouvel etat
            // action.target.id
            
            let choix
                if (action.target.id === 'en_cour') {
                    
                    console.log('est egale')
                    choix = 'en cour'

                } else {
                    console.log('ne lest pas')

                   choix = action.target.id
                }
            // }

            let prefixDeTest = choix.substring(0, 2)
            console.log(prefixDeTest, " la liste prefixe")

            if (btnChoix.includes(prefixDeTest)) {
                console.log("meme choix")
            } else {
                EnregistrerEtat(choix, id_tache, eventBtn)
            }


            dropdownContent.classList.toggle('show');


        })


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



// formEtat.addEventListener('submit', event => {
//     // event.preventDefault();

//     const formData = new FormData(formEtat);
//     console.log('test')

//     console.log(id_tache)

//     formData.append('id_tache', id_tache);
//     fetch('etatTache.php', {
//         method: 'POST',
//         body: formData
//     })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 // console.log(test)
//                 console.log(data)
//                 valTache.innerHTML = `${data.valeur}`
//                 modalEtat.style.display = 'none';

//             } else {
//                 console.log("erreurrrr !")
//             }

//         })
//         .catch(error => {
//             console.log('erreur :', error)
//         })

// })

const EnregistrerEtat = (choixUser, id_tache, event) => {

    const formData = new FormData
    formData.append('id_tache', id_tache);
    formData.append('choixUser', choixUser);

    fetch('etatTache.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // console.log(test)
                console.log(data)

                const button = event.target
                const textElement = button.querySelector('span');
                textElement.textContent = data.valeur

            } else {
                console.log("erreurrrr !")
            }

        })
        .catch(error => {
            console.log('erreur :', error)
        })

}

