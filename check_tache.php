<?php
header('Content-Type: application/json');

session_start();

$id = $_SESSION['id'];


require '../database.php';
$response = ['success' => false];

$current_time = date('Y-m-d H:i:s');

try {
    $con = Database::connect();
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $con->prepare('SELECT * FROM tache JOIN utilisateur ON tache.id = utilisateur.id WHERE tache.delai <= ? AND notifier = FALSE AND utilisateur.id='.$id);

    $stmt->execute([$current_time]);
    $taches = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $response['liste_tache'] = $taches;


    foreach ($taches as $tache) {
        $response['success'] = true;


                $id_user = $tache['id'];
                $id_tache = $tache['id_tache'];


                //Creer la notification
                $creerNotif = $con->prepare('INSERT INTO notif (id_user, id_tache) VALUES (?,?)');
                $creerNotif->execute(array($id_user, $id_tache));


                //Modifie l'etat de la notification
                $stmt = $con->prepare("UPDATE tache SET notifier = TRUE WHERE tache.id_tache =?");
                $stmt->execute([$tache['id_tache']]);
            
    }


     

} catch (PDOException $e) {
    $response['error'] = 'Erreur de connexion à la base de données : ' . $e->getMessage();
}

Database::disconnect();

echo json_encode($response);
