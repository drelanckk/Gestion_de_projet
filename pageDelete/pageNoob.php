<?php
// echo "chef";
require '../../database.php';
session_start();
$id = $_SESSION['id'];

try {
    $db = Database::connect();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $recupTac = $db->query('SELECT DISTINCT projet.id_projet, projet.nom_project, projet.detail, projet.date_creat FROM projet JOIN tache ON projet.id_projet = tache.id_projet  JOIN utilisateur ON tache.id = utilisateur.id WHERE utilisateur.id = ' . $id);



} catch (Exception $e) {
    echo 'erreur de connexio' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../header.css">

    <!-- <script src="script_Modal.js" defer></script> -->
    <!-- <link rel="stylesheet" href="../styleFormulaire.css"> -->
    <title>Document</title>
</head>


<header>
    <div class="container">

        <nav class="navigation">
            <ul>
                <li><a href="pageNoob.php">Accueil</a></li>
                <li><a href="profilNoob.php" id="btnProfil">profil</a></li>
                <li><a href="../chat/chat.php">chat</a></li>

            </ul>
        </nav>
        <div class="header-title">
            <h1>Bienvenue sur Alpha</h1>
            <!-- <p>Votre partenaire de confiance</p> -->
        </div>
    </div>
</header>

<body>

    <div class="addProjet">
        <h2>liste projet</h2>
    </div>

    <div class="centrer">

        <table>
            <thead>
                <tr>
                    <th>Nom du projet</th>
                    <th>Description</th>
                    <th>Date de creation</th>
                </tr>
            </thead>
            <tbody id="mesTaches">
                <?php

                while ($projet = $recupTac->fetch(PDO::FETCH_ASSOC)) {

                    echo '<tr>';
                    echo '<td><a href="../listeTaches.php?id=' . $projet['id_projet'] . '">' . $projet['nom_project'] . '</a></td>';
                    echo '<td>' . $projet['detail'] . '</td>';
                    echo '<td>' . $projet['date_creat'] . '</td>';
                    echo '<tr>';
                }
                

                ?>

            </tbody>
        </table>
    </div>


</body>

</html>