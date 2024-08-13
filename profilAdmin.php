<?php
require '../database.php';

session_start();
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="header.css">
    <script src="script/profil.js" defer></script>
    <!-- <script src="page_user/script_Modal.js" defer></script> -->
    <script src="script/deconnexion.js" defer></script>



    <title>Document</title>
</head>

<body>

    <header>
        <div class="container">

            <nav class="navigation">
                <ul>
                    <li><a href="pageChef.php">Accueil</a></li>
                    <li><a href="profilAdmin.php" id="btnProfil">profil</a></li>
                    <?php
                    if ($role == 'chef') {
                        echo '  <li><a href="historique.php">historique</a></li>';
                    }
                    ?>
                    <li><a href="chatAdmin.php">chat</a></li>
                </ul>
            </nav>
            <div class="header-title">
                <h1>Bienvenue sur Alpha</h1>
                <!-- <p>Votre partenaire de confiance</p> -->
            </div>
        </div>
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
            <div>
                <button id="btnDecon" class="btnDec">Deconnexion ?</button>

            </div>

        </section>



    </main>

    <!-- modal de deconnexion -->
    <section>
        <div id="myModal2" class="modal">
            <div class="modal-content">
                <span class="close2">&times;</span>
                <!-- <p> popup modale!</p> -->
                <div class="centrerVerticalement" id="popup">
                    <h2>voulez vous vraiment vous deconnecter?</h2>
                    <button id="btnOui">oui</button>
                    <button id="btnNon">non</button>
                </div>
            </div>
        </div>
    </section>



</body>

</html>