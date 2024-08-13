<?php
require '../database.php';

$conn = Database::connect();


// Récupérer l'historique des opérations
$sql = "SELECT *, utilisateur.nom FROM historique
        JOIN utilisateur ON historique.utilisateur_id = utilisateur.id
        ORDER BY historique.date_operation DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Historique des opérations</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="header.css">

</head>

<body>
    <header id="head">
        <div class="container">

            <nav class="navigation">
                <ul>
                    <li><a href="pageChef.php">Accueil</a></li>
                    <li><a href="profilAdmin.php" id="btnProfil">profil</a></li>
                    <li><a href="historique.php">historique</a></li>
                    <li><a href="chatAdmin.php">chat</a></li>

                </ul>
            </nav>
            <div class="header-title">
                <h1>Bienvenue sur Alpha</h1>
                <!-- <p>Votre partenaire de confiance</p> -->
            </div>
        </div>
    </header>





    <div class="addProjet">
        <h2>Historique des opérations</h2>
        <button id="export-btn">exporter</button>
    </div>

    <div class="centrer">
        <table>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Opération</th>
                <th>Date</th>
                <th>Détails</th>
            </tr>
            <?php
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nom"] . "</td>";
                    echo "<td>" . $row["operation"] . "</td>";
                    echo "<td>" . $row["date_operation"] . "</td>";
                    echo "<td>" . $row["details"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucune opération trouvée</td></tr>";
            }

            Database::disconnect();
            ?>
        </table>

    </div>



    <script>
        document.getElementById('export-btn').addEventListener('click', function() {
            window.location.href = 'export_history.php';
        });
    </script>
</body>

</html>