<?php

header('Content-Type: application/json');
session_start();

require "../database.php";
$response = ['success' => false];


// $projet = $con->query('SELECT * FROM projet')->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nomProjet = $_POST['nomProjet'];
    $detail = $_POST['detail'];

    $id= $_SESSION['id'];


    $today = date('Y-m-d');
    try {
        $con = Database::connect();
        $insertProj = $con->prepare('INSERT INTO projet (nom_project, detail , date_creat) VALUES (?,?,?)');
        if ($insertProj->execute(array($nomProjet, $detail, $today))) {
            $response['success'] = true;

            //enregistrer dans l'historique
            $operation = 'nouveau projet';
            $details = 'nom Projet : '.$nomProjet ;

            enregistrerHistorique($con, $id, $operation, $details);

           
        }
        
        
        $recupTac = $con->query("SELECT * FROM projet WHERE nom_project='" . $nomProjet . "'");
        $response['formData'] = $recupTac->fetch(PDO::FETCH_ASSOC);

        // ['nomProjet' => $nomProjet, 'detail' => $detail, 'date_creat' => $today];
    } catch (PDOException $e) {
        $response['error'] = 'Erreur de connexion à la base de données : ' . $e->getMessage();
    }

} else {
    $response['error'] = 'Données du formulaire manquantes';
}

Database::disconnect();
echo json_encode($response);
?>