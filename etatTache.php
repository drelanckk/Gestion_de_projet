<?php
header('Content-Type: application/json');

session_start();

require '../database.php';
$response = ['success' => false];
$id= $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $choixUser = $_POST['choixUser'];
    $id_tache = $_POST['id_tache'];


    try {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        if ($changEtat= $con->query('UPDATE tache SET etat = " '. $choixUser . '" WHERE tache.id_tache ='.$id_tache)) {
            $response['success'] = true;

            //creer notif
            $creerNotif =  $con->prepare('INSERT INTO notif (id_user, id_tache) SELECT id, ? FROM utilisateur WHERE role = "chef"');
            $creerNotif->execute(array($id_tache));



            //enregistrer dans l'historique
            $operation = 'modifier etat tache';
            $details = 'nouvel etat : '.$choixUser ;
            

            enregistrerHistorique($con, $id, $operation, $details);

            $response['valeur'] = $choixUser ;
        }
    } catch (PDOException $e) {
        $response['error'] = 'Erreur de connexion à la base de données : ' . $e->getMessage();
    }


} else {

    //changer l'etat de la notif

    try {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $changEtat= $con->prepare('UPDATE notif SET etat = "lue" WHERE id_user = ? AND etat = "non lue"');
        

       
        if ($changEtat->execute(array($id))) {
            $response['success'] = true;



            //enregistrer dans l'historique
            $operation = 'notification ouverte';
            $details = 'nouvel etat : lue' ;

            enregistrerHistorique($con, $id, $operation, $details);

        }
    } catch (PDOException $e) {
        $response['error'] = 'Erreur de connexion à la base de données : ' . $e->getMessage();
    }

    
}

Database::disconnect();

echo json_encode($response);

?>