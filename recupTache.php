<?php
header('Content-Type: application/json');

require '../database.php';
$response = ['success' => false];


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nomTache = $_POST['nomTache'];
    $delai = $_POST['delai'];
    $choixUser = $_POST['choixUser'];
    $id = $_POST['id'];


    $today = date('Y-m-d');
    try {
        $con = Database::connect();
        $insertProj = $con->prepare('INSERT INTO tache (nom_tache, date_creat, delai , id, id_projet) VALUES (?,?,?,?,?)');
        if ($insertProj->execute(array($nomTache, $today, $delai, $choixUser, $id))) {
            $response['success'] = true;





            //enregistrer dans l'historique
            $operation = 'nouvelle tache';
            $details = 'name task : '.$nomTache ;

            enregistrerHistorique($con, $id, $operation, $details);


            //recuperer la tache creeer
            $recupTacCreer = $con->prepare('SELECT * FROM tache WHERE nom_tache= ?');
            $recupTacCreer ->execute(array($nomTache));

            // $response['formData'] = ['nomTache' => $nomTache, 'date_creat' => $today, 'delai' => $delai, 'etat' => 'en cours'];
            $maTache = $recupTacCreer->fetch(PDO::FETCH_ASSOC);
            $response['formData'] = $maTache;


              
            //creer notif
            $id_tache = $maTache['id_tache'];
            $creerNotif =  $con->prepare('INSERT INTO notif (id_tache, id_user) VALUES (?,?)');
            $creerNotif->execute(array($id_tache, $choixUser));

            //recuperer toute les notifs
            $recupNotif = $con->query('SELECT * FROM notif ');
            $notifications = $recupNotif->fetchAll(PDO::FETCH_ASSOC);
            $response['listeNotif'] = $notifications;





            //recuperer toute les taches pour le tri 
            $recupTac = $con->query('SELECT * FROM tache WHERE id_projet=' . $id);
            $Taches = $recupTac->fetchAll(PDO::FETCH_ASSOC);


            $response['listeTaches'] = $Taches;

        }
    } catch (PDOException $e) {
        $response['error'] = 'Erreur de connexion à la base de données : ' . $e->getMessage();
    }


} else {
    $response['error'] = 'Données du formulaire manquantes';
}

Database::disconnect();

echo json_encode($response);

?>