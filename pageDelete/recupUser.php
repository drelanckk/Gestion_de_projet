<?php 
require '../../database.php';

session_start();

try{
    $id = $_SESSION['id'];

    $db= Database::connect();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt= $db->query('SELECT * FROM utilisateur WHERE id='.$id);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);


}catch(PDOException $e){
    echo 'erreur de connexion'.$e->getMessage();
}
    
echo json_encode($user);

?>