<?php
session_start();
require "../database.php";
$nom = $pwd = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $nom = $_POST['nom'];
    $pwd = $_POST['pwd'];

    try {
        $con = Database::connect();
        $recupdON = $con->prepare('SELECT * FROM utilisateur WHERE nom=? AND pwd=?');
        $recupdON->execute(array($nom, $pwd));

        if ($recupdON->rowCount() > 0) {

            $val = $recupdON->fetch(PDO::FETCH_ASSOC);

            $_SESSION['role'] = $val['role'];
            $_SESSION['id'] = $val['id'];

            //enregistrement historique
            $utilisateur_id =  $val['id'];;
            $operation = 'connexion';
            $details = 'connexion ' . $val['role'];

            enregistrerHistorique($con, $utilisateur_id, $operation, $details);

            // if ($val['role'] == 'chef') {
            header('Location:pageChef.php');
            // } else {
            //     header('Location:page_user/pageNoob.php');
            // }


        } else {
            $echec = 'Données incorrect';

            // echo 'donner incorrect';

        }
    } catch (PDOException $e) {
        echo 'erreur de connexion' . $e->getMessage();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styleFormulaire.css">
    <title>projet</title>
</head>

<body>
    <?php 
    if(isset(($echec ))){
        echo "<h2>". $echec ."</h2>";
    }
    ?>
    <h1>connexion</h1>
    <main>
        <form id="myForm" method="POST" action="projet.php">
            <label for="name">Nom:</label>
            <input type="text" id="nom" name="nom" placeholder="">
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="pwd">
            <input type="submit" id="submitBtn" value="connexion">

        </form>
</body>

</html>