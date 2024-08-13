<?php
header('Content-Type: application/json');

require '../database.php';

// effectuer le tri des taches et afficher cote admin


if ($_SERVER['REQUEST_METHOD'] == "GET") {
   
    $id = '';
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
    }
    

    try {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_GET['id'];

        $recupTac = $con->query('SELECT * FROM tache WHERE id_projet=' . $id);
        $Taches = $recupTac->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($Taches);

        Database::disconnect();

    }catch (PDOException $e) {
        // Gestion des erreurs PDO
        $response['error'] = 'Erreur de connexion à la base de données : ' . $e->getMessage();
        echo json_encode($response); // Retourner une réponse JSON en cas d'erreur
    }
}

?>