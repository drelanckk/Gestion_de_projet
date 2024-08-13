
let formChoix = document.getElementById("formChoix")
let infoAfficher = document.getElementById('infoAfficher')
let choix = document.getElementById('choix')
let zoneModifier = document.getElementById("zoneModifier")

let user

// fetch('recupUser.php')
//     .then(Response => Response.json())
//     .then(data => {
//         user = data
//         console.log(user, 'userrrr')
//     })


formChoix.addEventListener('submit', function (event) {

    event.preventDefault();
    // console.log(user.nom)

    // let monChoix = choix.value
    // let valeur = infoAfficher.value
    const formData = new FormData(document.getElementById('formChoix'));
    // formData.append('monChoix', monChoix);

    fetch('modifUser.php', {
        method: 'POST',
        body: formData
    })
        .then(Response => Response.json())
        .then(data => {
            console.log(data, 'check')
            if (data.success) {
                console.log("success")
                zoneModifier.innerHTML = 'Modifications effectuer !'
            }

        })

})

