<?php

header('Content-Type: application/json');
session_start();

require "../../database.php";
$response = ['success' => false];


// $projet = $con->query('SELECT * FROM projet')->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $sms = $_POST['sms'];

    $id = $_SESSION['id'];

    try {

        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $imageName = null;

        // Vérifiez si un fichier a été téléchargé
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $imageName = $_FILES['image']['name'];
            $uploadFileDir = './img/'; //a check
            $dest_path = $uploadFileDir . $imageName;

            // Déplacez le fichier téléchargé vers le répertoire de destination
            if (!move_uploaded_file($imageTmpPath, $dest_path)) {
                throw new Exception('There was an error moving the uploaded file.');
            }

            // Enregistrez le message et l'image dans la base de données
            $insertMessage = $con->prepare('INSERT INTO chat (message,image, id) VALUES (?,?,?)');
            if ($insertMessage->execute(array($sms, $imageName, $id))) {
                $response['success'] = true;

                //enregistrer dans l'historique
                $operation = 'nouveau message';
                $details = 'valeur : ' . $sms;

                enregistrerHistorique($con, $id, $operation, $details);
            }



        } else {


            $insertMessage = $con->prepare('INSERT INTO chat (message, id) VALUES (?,?)');
            if ($insertMessage->execute(array($sms, $id))) {
                $response['success'] = true;

                //enregistrer dans l'historique
                $operation = 'nouveau message';
                $details = 'valeur : ' . $sms;

                enregistrerHistorique($con, $id, $operation, $details);
            }

        }


        //corrige l'acces au donnes
        $recupMessage = $con->prepare("SELECT *, utilisateur.nom FROM chat JOIN utilisateur ON utilisateur.id = chat.id  WHERE chat.id = ? AND chat.message = ?");
        $recupMessage->execute(array($id, $sms));
        $response['formData'] = $recupMessage->fetch(PDO::FETCH_ASSOC);




    } catch (PDOException $e) {
        $response['error'] = 'Erreur de connexion à la base de données : ' . $e->getMessage();
    }

   



    // try {
    //     $con = Database::connect();
    //     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //     $insertMessage = $con->prepare('INSERT INTO chat (message, id) VALUES (?,?)');
    //     if ($insertMessage->execute(array($sms, $id))) {
    //         $response['success'] = true;

    //         $operation = 'nouveau message';
    //         $details = 'valeur : ' . $sms;

    //         enregistrerHistorique($con, $id, $operation, $details);


    //     }


    //     $recupMessage = $con->prepare("SELECT *, utilisateur.nom FROM chat JOIN utilisateur ON utilisateur.id = chat.id  WHERE chat.id = ? AND chat.message = ?");
    //     $recupMessage->execute(array($id, $sms));
    //     $response['formData'] = $recupMessage->fetch(PDO::FETCH_ASSOC);

    // } catch (PDOException $e) {
    //     $response['error'] = 'Erreur de connexion à la base de données : ' . $e->getMessage();
    // }

} else {
    $response['error'] = 'Données du formulaire manquantes';
}

Database::disconnect();
echo json_encode($response);
?>