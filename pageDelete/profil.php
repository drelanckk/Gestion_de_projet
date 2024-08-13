<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <script src="profil.js" defer></script>
    <script src="script_Modal.js" defer></script>


    <title>Document</title>
</head>

<body>
    <header>
        <section class="head">
            <div>
                <a href="pageNoob.php">accueil</a>
            </div>
            <div>
                <a href="" id="btnProfil">profil</a>
            </div>
            <div>
                <button id="myButton">deconnexion</button>
            </div>
        </section>
    </header>

    <main>

        <section id="zoneModifier">
            <h2>Quel attribut voulez vous modifier?</h2>
            <form action="" id="formChoix">
                <select name="choix" id="choix">
                    <option value="">selectionner</option>
                    <option value="Nom">Nom</option>
                    <option value="email">email</option>
                    <option value="pwd">password</option>

                </select>

                <label for="">entrer la nouvelle valeur </label>
                <input type="text" placeholder="" id="infoAfficher" name="infoAfficher">
                <input type="submit" id="submitBtn" value="Modifier">
            </form>
        </section>


        <!-- modal de deconnexion -->
        <section>
            <div id="myModal2" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <!-- <p> popup modale!</p> -->
                    <div class="centrerVerticalement" id="popup">
                        <h2>voulez vous vraiment vous deconnecter?</h2>
                        <button id="btnOui">oui</button>
                        <button id="btnNon">non</button>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>