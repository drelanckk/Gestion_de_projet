<?php
require "../database.php";
session_start();
$role = $_SESSION['role'];


try {
    $con = Database::connect();
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $recupMessage = $con->query("SELECT *, utilisateur.nom FROM chat JOIN utilisateur ON utilisateur.id = chat.id  ");

} catch (Exception $e) {
    echo 'erreur de connexio' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="chat/chat.css">
    <script src="script/chatAdmin.js" defer></script>


    <title>Document</title>
</head>

<body>
    <header>
        <div class="container">

            <nav class="navigation">
                <ul>
                    <li><a href="pageChef.php">Accueil</a></li>
                    <li><a href="profilAdmin.php" id="btnProfil">profil</a></li>
                    <?php
                    if ($role == 'chef') {
                        echo '  <li><a href="historique.php">historique</a></li>';
                    }
                    ?>
                    <li><a href="#">chat</a></li>
                </ul>
            </nav>
            <div class="header-title">
                <h1>Bienvenue sur Alpha</h1>
                <!-- <p>Votre partenaire de confiance</p> -->
            </div>
        </div>
    </header>

    <!-- <main>
        <section class="chat">
            <div class="afficheSms" id="zoneAffic">
                
                <?php


                ?>
            </div>

            <div class="sendSms">
                <form action="" id="formChat">
                    <input type="text" name="sms" placeholder="envoyer un message">
                    <button type="submit"><img src="chat/send-alt-2-svgrepo-com.svg" alt="bouton_send"
                            class="imgSvg"></button>
                </form>
            </div>
        </section>
    </main> -->

    <section class="Chat">
        <div class="chat-container">

            <div class="chat-box" id="zoneAffic"></div>

            <form action="" id="formChat">
                <div class="input-area">
                    <input type="text-area" name="sms" placeholder="envoyer un message" id="messageInput">
                    <input type="file" name="image" id="image-upload" accept="image/*">
                    <button type="submit" id="sendButton"><img src="chat/send-alt-2-svgrepo-com.svg" alt="bouton_send"
                            class="imgSvg"></button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>