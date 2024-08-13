//modalDecon 1 pour la deconnexion

let modalDecon = document.getElementById('myModal2');
let btn = document.getElementById('btnDecon');
let span = document.querySelector(".close2")



btn.onclick = function () {
    modalDecon.style.display = 'block';
}

// Fermer la popup 
span.onclick = function () {
    modalDecon.style.display = 'none';
}

// Fermer la popup quand l'utilisateur clique n'importe où en dehors de la popup
window.onclick = function (event) {
    if (event.target == modalDecon) {
        modalDecon.style.display = 'none';
    }
}


let btnOui = document.getElementById("btnOui")
let btnNon = document.getElementById("btnNon")


btnOui.addEventListener('click', ()=>{
   
    window.location.href = "../projet.php";
})

btnNon.addEventListener('click', ()=>{
    modalDecon.style.display = 'none';
})
