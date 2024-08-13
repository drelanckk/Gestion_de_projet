//modal 1 pour la deconnexion

var modal = document.getElementById('myModal2');
var btn = document.getElementById('myButton');
var span = document.querySelector(".close")



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


let btnOui = document.getElementById("btnOui")
let btnNon = document.getElementById("btnNon")


btnOui.addEventListener('click', ()=>{
   
    window.location.href = "../projet.php";
})

btnNon.addEventListener('click', ()=>{
    modal.style.display = 'none';
})


//modal 2 pour le profil

// let btnProfil = document.getElementById("btnProfil")
// let ModalProfil = document.getElementById("ModalProfil")



// btnProfil.onclick = function () {
//     ModalProfil.style.display = 'block';
// }
