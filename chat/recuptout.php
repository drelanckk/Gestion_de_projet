<?php

header('Content-Type: application/json');
session_start();

$id = $_SESSION['id'];

require "../../database.php";

    try {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       
        
        $message = $con->query("SELECT *, utilisateur.nom FROM chat JOIN utilisateur ON utilisateur.id = chat.id  ORDER BY date ASC");
        $recupMessage = $message->fetchAll(PDO::FETCH_ASSOC);
        $response['formData'] = $recupMessage;
        $response['id_session'] = $id;


        // ['nomProjet' => $nomProjet, 'detail' => $detail, 'date_creat' => $today];
    } catch (PDOException $e) {
        $response['error'] = 'Erreur de connexion à la base de données : ' . $e->getMessage();
    }


Database::disconnect();
echo json_encode($response);
?>