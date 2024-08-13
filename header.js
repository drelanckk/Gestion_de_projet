let head = document.getElementById('head')

head.innerHTML = `<div class="container">

            <nav class="navigation">
                <ul>
                    <li><a href="pageChef.php">Accueil</a></li>
                    <li><a href="profilAdmin.php" id="btnProfil">profil</a></li>
                    <li><a href="historique.php">historique</a></li>
                    <li><a href="chatAdmin.php">chat</a></li>
                    <button id="btnNotif">notification</button>

                </ul>
            </nav>
            <div class="header-title">
                <h1>Bienvenue sur Alpha</h1>
                <!-- <p>Votre partenaire de confiance</p> -->
            </div>
        </div>`