<?php
require "../../database.php";


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
    <link rel="stylesheet" href="../header.css">
    <link rel="stylesheet" href="chat.css">
    <script src="chat.js" defer></script>


    <title>Document</title>
</head>

<body>
    <header>
        <div class="container">

            <nav class="navigation">
                <ul>
                    <li><a href="../page_user/pageNoob.php">Accueil</a></li>
                    <li><a href="../page_user/profilNoob.php" id="btnProfil">profil</a></li>
                    <li><a href="#">chat</a></li>
                </ul>
            </nav>
            <div class="header-title">
                <h1>Bienvenue sur Alpha</h1>
                <!-- <p>Votre partenaire de confiance</p> -->
            </div>
        </div>
    </header>

    <main>
        <section class="Chat">
            <div class="chat-container">

                <div class="messages" id="zoneAffic"></div>

                <form action="" id="formChat">
                    <div class="input-area">
                        <input type="text" name="sms" placeholder="envoyer un message" id="messageInput" >
                        <button type="submit" id="sendButton"><img src="send-alt-2-svgrepo-com.svg" alt="bouton_send"
                                class="imgSvg"></button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>

</html>