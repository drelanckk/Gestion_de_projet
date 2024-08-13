var modal = document.getElementById('myModal');
var btn = document.getElementById('myButton');
var span = document.querySelector(".close")

let mesTaches = document.getElementById("mesTaches")

let myForm = document.getElementById("myForm")

//barre de recherche
let search = document.getElementById("search")




btn.onclick = function () {
    modal.style.display = 'block';
}

// Fermer la popup 
span.onclick = function () {
    modal.style.display = 'none';
}

// Fermer la popup quand l'utilisateur clique n'importe où en dehors de la popup
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}


const afficher_taches = (tab) => {
    // console.log(element)
    mesTaches.innerHTML += `        
    <tr>
        
        <td>${tab.nom_tache}</td>
        <td>${tab.date_creat}</td>
        <td>${tab.delai}</td>
        <td> <div>
                <span id="valTache">${tab.etat}</span>
                <button id="${tab.id_tache}">modifier</button>
             </div>
        </td>
    </tr>`
}



myForm.addEventListener('submit', function (event) {

    event.preventDefault();

    const urlParams = new URLSearchParams(window.location.search);

    const formData = new FormData(document.getElementById('myForm'));

    let id = urlParams.get('id')
    console.log(id)

    formData.append('id', id);


    fetch('recupTache.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let tab = data.formData
                console.log("donner recu :", data)
                afficher_taches(tab)
                // afficher_Tout_taches(tab)
                modal.style.display = 'none';


            } else {
                console.log("erreurrrr !")
            }

        })
        .catch(error => {
            console.log('erreur :', error)
        })
})

//barre de recherche en temps reel
search.addEventListener('input', function (e) {

    const urlParams = new URLSearchParams(window.location.search);

    let id = urlParams.get('id')
    console.log(id)

    let url = 'triTaches.php?id=' + id;

    fetch(url, {
        method: 'GET'
    })
        .then(response => response.json())
        .then(data => {

            const filtre = data.filter((element) => {
                if (element.nom_tache.toLowerCase().includes(e.target.value.toLowerCase())) {
                    return element
                } else {

                }

            })
            if (filtre.length < 1) {
                mesTaches.innerHTML = "<b>Aucune donnée trouvee</b>";
            } else {
                // console.log(filtre)
                afficher_Tout_taches(filtre)
            }
            // console.log(data)
        })
})


const afficher_Tout_taches = (tab) => {

    mesTaches.innerHTML = ''

    tab.map((element) => {
        mesTaches.innerHTML += `        
        <tr>
            
            <td>${element.nom_tache}</td>
            <td>${element.date_creat}</td>
            <td>${element.delai}</td>
             <td> <div>
                <span id="valTache">${element.etat}</span>
                <button id="${element.id_tache}">modifier</button>
             </div>
        </td>
        </tr>`

        console.log(element.id_tache)
    })
}

const creerNotif= ()=>{

    
}



