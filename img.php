<?php
header('Content-Type: application/json');

require "../database.php";

try {
    
    $con = Database::connect();
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $imageName = null;

    // Vérifiez si un fichier a été téléchargé
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $uploadFileDir = './uploads/';
        $dest_path = $uploadFileDir . $imageName;

        // Déplacez le fichier téléchargé vers le répertoire de destination
        if (!move_uploaded_file($imageTmpPath, $dest_path)) {
            throw new Exception('There was an error moving the uploaded file.');
        }
    }

    // Enregistrez le message et l'image dans la base de données
    $stmt = $con->prepare("INSERT INTO messages (message, image) VALUES (:message, :image)");
    $stmt->execute(['message' => $message, 'image' => $imageName]);

    $response = [
        'status' => 'success',
        'message' => $message,
        'image' => $imageName
    ];

} catch (Exception $e) {
    $response = [
        'status' => 'error',
        'message' => $e->getMessage()
    ];
}

echo json_encode($response);
?>
