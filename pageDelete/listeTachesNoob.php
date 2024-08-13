<?php

//n'est plus utiliser


session_start();
require '../../database.php';

$id = '';
$id_projet = '';

$id = $_SESSION['id'];

if (isset($_GET['id'])) {
    $id_projet = $_GET['id'];


}

try {
    $db = Database::connect();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $recupTac = $db->query('SELECT * FROM tache JOIN utilisateur ON tache.id = utilisateur.id JOIN projet ON tache.id_projet = projet.id_projet WHERE utilisateur.id = ' . $id . ' AND projet.id_projet = ' . $id_projet);

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
    <link rel="stylesheet" href="../header.css">

    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
</head>

<body>


    <header>
        <div class="container">

            <nav class="navigation">
                <ul>
                    <li><a href="pageNoob.php">Accueil</a></li>
                    <li><a href="profilNoob.php" id="btnProfil">profil</a></li>
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
    </div>

    <div class="centrer">

        <table>
            <thead>
                <tr>
                    <th>nom</th>
                    <th>date de creation</th>
                    <!-- <td>user attribuer</td> -->
                    <th>delai</th>

                </tr>
            </thead>
            <tbody id="mesTaches">
                <?php

                while ($tache = $recupTac->fetch(PDO::FETCH_ASSOC)) {

                    echo '<tr>';
                    echo '<td>' . $tache['nom_tache'] . '</td>';
                    echo '<td>' . $tache['date_creat'] . '</td>';
                    echo '<td>' . $tache['delai'] . '</td>';
                }

                ?>


            </tbody>
        </table>
    </div>


</body>

</html>