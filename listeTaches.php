<?php

require '../database.php';
session_start();

//pour le user

// $id = '';
$id_projet = '';

$id = $_SESSION['id'];
$id_projet = $_GET['id'];

$role = $_SESSION['role'];

// try {
//     $db = Database::connect();
//     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     $recupTac = $db->query('SELECT * FROM tache JOIN utilisateur ON tache.id = utilisateur.id JOIN projet ON tache.id_projet = projet.id_projet WHERE utilisateur.id = ' . $id . ' AND projet.id_projet = ' . $id_projet);
// } catch (Exception $e) {
//     echo 'erreur de connexio' . $e->getMessage();
// }



try {
    $db = Database::connect();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($role == 'chef') {
        $recupTac = $db->prepare('SELECT * FROM tache WHERE id_projet= ? ');
        $recupTac->execute(array($id_projet));
    } else {
        $recupTac = $db->query('SELECT * FROM tache JOIN utilisateur ON tache.id = utilisateur.id JOIN projet ON tache.id_projet = projet.id_projet WHERE utilisateur.id = ' . $id . ' AND projet.id_projet = ' . $id_projet);
    }
} catch (Exception $e) {
    echo 'erreur de connexio' . $e->getMessage();
}

Database::disconnect();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="style/popupEtat.css">

    <script src="script/scriptTache.js" defer></script>
    <script src="script/etatTache.js" defer></script>


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
                    <button id="btnNotif">notification</button>

                </ul>
            </nav>
            <div class="header-title">
                <h1>Bienvenue sur Alpha</h1>
                <!-- <p>Votre partenaire de confiance</p> -->
            </div>
        </div>
    </header>


    <div class="addProjet">
        <h1>liste des taches du projet ...!</h1>
        <?php
        if ($role == 'chef') {
            echo ' <button id="myButton">Ajouter</button> ';
        }else{
            echo ' <button id="myButton" class="none">Ajouter</button> ';
        }

        ?>
        <input type="search" placeholder="rechercher" id="search">
    </div>


    <div class="centrer">

        <table>
            <thead>
                <tr>
                    <th>nom</th>
                    <th>date de creation</th>
                    <!-- <td>user attribuer</td> -->
                    <th>delai</t>
                    <th>etat</t>


                </tr>
            </thead>
            <tbody id="mesTaches">
                <?php

                while ($tache = $recupTac->fetch(PDO::FETCH_ASSOC)) {

                    echo '<tr>';
                    echo '<td>' . $tache['nom_tache'] . '</td>';
                    echo '<td>' . $tache['date_creat'] . '</td>';
                    echo '<td>' . $tache['delai'] . '</td>';

                    echo '<td> 
                    
                    <div id="btnEtat">
                        <button class="dropdown-button" id="'. $tache['id_tache'] . '"><span>' . $tache['etat'] . '
                       </span> <img src="img/icon_modif.svg" alt="icon" class="svg" ></button>

                        <div class="dropdown-content">
                            <a href="#" id="en_cour">en cour</a>
                            <a href="#" id="terminer">terminer</a>
                            
                          
                        </div>
                    </div></td>';


                    echo '</tr>';
                }

                ?>

 <!-- modifier l'etat de la  tache  -->

 <div id="modalEtat" class="popupEtat">
            <div class="contentEtat">
                <span class="close2">&times;</span>
                <!-- <p> popup modale!</p> -->
                <!-- <div class="centrerVerticalement" id="popup"> -->
                    <h2>Modifier l'etat</h2>
                    <!-- <form id="formEtat" method="post">
                        <select name="choixUser" id="">
                            <option value="">selectionner</option>
                            <option value="en_cours">en cours</option>
                            <option value="terminer">terminer</option>
                        </select>
                        <input type="submit" value="modifier">

                    </form> -->

                </div>
            </div>
        </div>



            </tbody>
        </table>

    </div>
    <section>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <!-- <p> popup modale!</p> -->
                <div class="centrerVerticalement" id="popup">
                    <h2>Ajouter une tache :</h2>

                    <form action="#?id=<?php echo $id ?>" id="myForm">
                        <input type="text" placeholder="nom tache" id="nomTache" name="nomTache" required>
                        <label for="date">delai : </label><input type="date" placeholder="delai" id="delai" name="delai" required>
                        <select name="choixUser" id="">
                            <option value="">choisir user</option>

                            <?php

                            $bd = Database::connect();
                            $stmt = $bd->query('SELECT * FROM utilisateur');

                            while ($user = $stmt->fetch()) {
                                echo '<option value="' . $user['id'] . '">' . $user['nom'] . '</option>';
                            }
                            Database::disconnect();
                            ?>
                        </select>

                        <input type="submit" id="submitBtn" value="enregistrer">

                    </form>

                </div>
            </div>
        </div>
    </section>



   





</body>

</html>