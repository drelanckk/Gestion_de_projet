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

mesBouton.forEach(bouton => {
    bouton.addEventListener('click', (event) => {

        id_tache = event.target.id
        console.log(id_tache)
        modalEtat.style.display = 'block';

    })
})

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

