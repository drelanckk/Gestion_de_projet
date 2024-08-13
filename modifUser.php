<?php 

require '../database.php';
$response['success'] = false;
session_start();

try{
    $id = $_SESSION['id'];
    $choix = $_POST['choix'];
    $infoAfficher = $_POST['infoAfficher'];



    $db= Database::connect();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if(   $stmt= $db->query('UPDATE utilisateur SET '. $choix .' = "'. $infoAfficher .'" WHERE id ='.$id)){
        $response['success'] = true;

        //enregistrer dans l'historique
        $operation = 'update user';
        $details = 'new '. $choix . '= '.$infoAfficher ;

        enregistrerHistorique($db, $id, $operation, $details);

    }
    

}catch(PDOException $e){
    echo 'erreur de connexion'.$e->getMessage();
    $response['success'] = false;
}
    
echo json_encode($response);

?>