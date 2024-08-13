let formChat = document.getElementById("formChat")
let zoneAffic = document.getElementById('zoneAffic')

formChat.addEventListener('submit', (event) => {

    event.preventDefault();

    const formData = new FormData(formChat)
    fetch('recupMessages.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('test')
                let tab = data.formData
                console.log("donner recu :", data)
                afficheSms(tab)
            } else {
                console.log("erreurrrr !")
            }

        })

})


const afficheSms = (tab) => {
    zoneAffic.innerHTML += `
        <div class="smsUser">
            <span>${tab.nom}, ${tab.date}</span>
            <p>${tab.message}</p>
        </div>`

}


const afficheTout = () => {

    let tab = []

    fetch('recuptout.php')
        .then(response => response.json())
        .then(data => {
            console.log('test')
            tab = data.formData
            // console.log("donner recu :", tab)
            
             zoneAffic.innerHTML = ''

            tab.forEach(element => {
                zoneAffic.innerHTML += `
                <div class="smsUser">
                    <span>${element.nom}, ${element.date}</span>
                    <p>${element.message}</p>
                </div>`;

            });


        }

        )

}

setInterval(afficheTout, 50)