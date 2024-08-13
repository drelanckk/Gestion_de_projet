<?php
// echo "chef";
require '../database.php';

session_start();
$id = $_SESSION['id'];
$role = $_SESSION['role'];

try {
    $db = Database::connect();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($role == 'chef') {
        $recupTac = $db->query('SELECT * FROM projet');
    } else {
        $recupTac = $db->query('SELECT DISTINCT projet.id_projet, projet.nom_project, projet.detail, projet.date_creat FROM projet JOIN tache ON projet.id_projet = tache.id_projet  JOIN utilisateur ON tache.id = utilisateur.id WHERE utilisateur.id = ' . $id);
    }
    $recupNotif = $db->query('SELECT * FROM notif JOIN tache ON notif.id_tache = tache.id_tache JOIN projet ON tache.id_projet = projet.id_projet WHERE id_user=' . $id . ' ORDER BY date DESC');
} catch (Exception $e) {
    echo 'erreur de connexio' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script/script.js" defer></script>
    <script src="script/notif.js" defer></script>
    <!-- <script src="header.js" defer></script> -->
    <link rel="stylesheet" href="header.css">
    <title>Document</title>
</head>

<body>

    <header id="head">
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
                    <li><button id="btnNotif">notification</button></li>
                    
                </ul>
            </nav>
            <div class="header-title">
                <h1>Bienvenue sur Alpha</h1>
                <!-- <p>Votre partenaire de confiance</p> -->
            </div>
        </div>
    </header>

    <main>

        <div class="addProjet">
            <h2>liste projet</h2>
            <?php if ($role == 'chef') {
                echo '  <button id="myButton">add Projet</button>';
            } else {
                echo '  <button id="myButton"  class="none">add Projet</button> ';
            } ?>


        </div>

        <div class="centrer">
            <table>
                <thead>
                    <tr>
                        <th>nom du projet</th>
                        <th>description</th>
                        <th>date de creation</th>
                    </tr>
                </thead>
                <tbody id="mesTaches">
                    <?php

                    while ($projet = $recupTac->fetch(PDO::FETCH_ASSOC)) {

                        echo '<tr>';
                        echo '<td><a href="listeTaches.php?id=' . $projet['id_projet'] . '">' . $projet['nom_project'] . '</a></td>';
                        echo '<td>' . $projet['detail'] . '</td>';
                        echo '<td>' . $projet['date_creat'] . '</td>';
                        echo '</tr>';

                        //   echo '<td><a href="listeTaches.php?id=${element.id_projet}">${element.nom_project}</a></td>'
                        //     <td>${element.detail}</td>
                        //     <td>${element.date_creat}</td>
                        // </tr>
                    }

                    ?>

                </tbody>
            </table>
        </div>

    </main>

    <section>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <!-- <p> popup modale!</p> -->
                <div class="centrerVerticalement" id="popup">
                    <h2>Ajouter un projet :</h2>
                    <form id="myForm">
                        <input type="text" placeholder="nom Projet" id="nomProjet" name="nomProjet" required>
                        <input type="text" placeholder="detail" id="detail" name="detail" required>
                        <input type="submit" id="submitBtn" value="enregistrer">

                    </form>

                </div>
            </div>
        </div>
    </section>



    <!-- popup notification -->
    <section>
        <div id="modalNotif">
            <div class="modal-content-notif">
                <div class="en-tete">
                    <h3>Notification</h3>
                    <span class="close2">&times;</span>
                </div>
                <!-- <p> popup modale!</p> -->
                <div class="centrerVerticalement" id="popup">
                    <div id="listeNotif">
                        <?php
                        if ($recupNotif->rowCount() > 0) {

                            while ($row = $recupNotif->fetch(PDO::FETCH_ASSOC)) {
                                if ($role == 'chef') {
                                    echo '<div class="notification">
                                  <span><u>la tache</u> :' . $row['nom_tache'] . ', du projet :' . $row['nom_project'] . ' est ' . $row['etat'] . '</span>
                                  </div>';
                                } else {
                                    echo '<div class="notification">
                                    <span><u>Nouvelle tache</u> :' . $row['nom_tache'] . ', du projet :' . $row['nom_project'] . '</span>
                                    </div>';
                                }
                            }
                        } else {
                            echo "<div><h3>Aucune notification</h3></div>";
                        }





                        ?>

                    </div>

                </div>
            </div>
        </div>
    </section>







</body>

</html>