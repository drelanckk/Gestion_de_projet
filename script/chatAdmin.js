let formChat = document.getElementById("formChat")
let zoneAffic = document.getElementById('zoneAffic')

let Gauche = document.getElementById('Gauche')

formChat.addEventListener('submit', (event) => {

    event.preventDefault();

    const formData = new FormData(formChat)
    fetch('chat/recupMessages.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('test')
                let tab = data.formData
                console.log("donner recu :", data)
                // afficheSms(tab)
            } else {
                console.log("erreurrrr !")
            }

        })

    formChat.reset();

})


const afficheSms = (tab) => {

    if (tab.image !== null) {
        zoneAffic.innerHTML += `
    <div class=" gauche" >
        <span>${tab.nom}, ${tab.date}</span>
        <p>${tab.message}</p>
        
                <img src="chat/img/${tab.image}" alt="img" class="img">
        
    </div>`;


    } else {
        zoneAffic.innerHTML += `
    <div class=" gauche">
        <span>${tab.nom}, ${tab.date}</span>
        <p>${tab.message}</p>
    </div>`;


    // Gauche.setAttribute('float', 'right')


    }


}

const afficheTout = () => {

    let tab = []

    fetch('chat/recuptout.php')
        .then(response => response.json())
        .then(data => {
            console.log('la data', data)
            tab = data.formData
            // console.log("donner recu :", tab)


            zoneAffic.innerHTML = ''
            tab.forEach(element => {

                if(data.id_session== element.id ){

                    if (element.image !== null) {
                        zoneAffic.innerHTML += `
                    <div class=" gauche">
                        <span>${element.nom}, ${element.date}</span>
                        <p>${element.message}</p>
                    <img src="chat/img/${element.image}" alt="img" class="img">
                    </div>`;



                    } else {
                        zoneAffic.innerHTML += `
                    <div class=" gauche">
                        <span>${element.nom}, ${element.date}</span>
                        <p>${element.message}</p>
                    </div>`;
    
                    }

                }else{
                    
                    if (element.image !== null) {
                        zoneAffic.innerHTML += `
                    <div class="smsUser">
                        <span>${element.nom}, ${element.date}</span>
                        <p>${element.message}</p>
                    <img src="chat/img/${element.image}" alt="img" class="img">
                    
    
                    </div>`;
                    } else {
                        zoneAffic.innerHTML += `
                    <div class="smsUser">
                        <span>${element.nom}, ${element.date}</span>
                        <p>${element.message}</p>
                    </div>`;
    
                    }
                }
                

            console.log(element)


            }
        
        );


        }

        )

}


// afficheTout()
setInterval(afficheTout, 50)