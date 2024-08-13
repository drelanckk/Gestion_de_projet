<?php
 require '../database.php';

 

 try{
    
    $conn = Database::connect();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
   
   
   
   // Requête pour obtenir l'historique des opérations
   $result = $conn->query("SELECT * FROM historique");
   
   if ($result->rowCount() > 0) {
       // Créer un fichier CSV et l'envoyer en tant que téléchargement
       header('Content-Type: text/csv');
       header('Content-Disposition: attachment; filename="user_history.csv"');
       
       $output = fopen('php://output', 'w');
       fputcsv($output, array('ID','date_operation','details' ,'Operation', 'User ID'));
   
       while($row = $result->fetch(PDO::FETCH_ASSOC)) {
           fputcsv($output, $row);
       }
       fclose($output);
   } else {
       echo "0 results";
   }}catch(PDOException $e) {

    echo 'erreur de connexion ' . $e->getMessage();
   }



 

?>
