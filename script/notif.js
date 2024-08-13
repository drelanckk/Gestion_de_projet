
//notif

let btnNotif =document.getElementById("btnNotif")
let modalNotif = document.getElementById("modalNotif")
var span = document.querySelector(".close2")


// btnNotif.onclick = function () {
//     modalNotif.style.display = 'block';
// }

span.onclick = function () {
    modalNotif.style.display = 'none';
}

btnNotif.addEventListener('click',()=>{
    modalNotif.style.display = 'block';

    
    fetch('etatTache.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
               console.log("MAJ du statut effectuer")
            } else {
                console.log("erreurrrr ! ")
            }

        })
        .catch(error => {
            console.log('erreur :', error)
        })

})

function fetchNotifications() {
    fetch('check_tache.php')
        .then(response => response.json())
        .then(data => {
            let listeNotif = document.getElementById('listeNotif');
            let info = data.liste_tache
            console.log(info)

            info.forEach(element => {
                listeNotif.innerHTML += `<div>
    <span>la tache ${element.nom_tache} est arriver a echeance</span>
</div>`
            });

            
          
        });
}

fetchNotifications()