var modal = document.getElementById('myModal');
var btn = document.getElementById('myButton');
var span = document.querySelector(".close")

let submitBtn = document.getElementById("submitBtn")
let test = document.getElementById("test")
let mesTaches = document.getElementById("mesTaches")

let myForm = document.getElementById("myForm")


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

// let mesData =[]

// test.addEventListener('click', ()=>{
//    console.log("click effectuer")
//     fetch('recupDonner.php')
//     .then(response => response.json())
//     .then(data =>{
//         console.log("donner recu :", data)
//         mesData =[...data] 
//     })
//     .catch(error =>{
//         console.error('erreur :', error)
//     })
// })

const afficher_Projet = (tab)=>{
    mesTaches.innerHTML += `        
    <tr>
        
        <td><a href="listeTaches.php?id=${tab.id_projet}">${tab.nom_project}</a></td>
        <td>${tab.detail}</td>
        <td>${tab.date_creat}</td>
    </tr>`  
}



//afficher mes projets
// fetch('recupProjet.php')
// .then(response => response.json())
// .then(data =>{
//     // console.log("donner recu :", data)
//     afficher_Projet(data)  
// })
// .catch(error =>{
//     console.error('erreur :', error)
// })

myForm.addEventListener('submit', function (event) {

    event.preventDefault();
    const formData = new FormData(document.getElementById('myForm'));
   
    fetch('recupProjet.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('test')
                let tab = data.formData
                console.log("donner recu :", data)
                afficher_Projet(tab)
            } else {
                console.log("erreurrrr !")
            }

        })
        // .catch(error => {
        //     console.log('erreur :', error)
        // })
})
