<?php

class Database
{
    private static $dbHost = "localhost";
    private static $dbName = "alpha2";
    private static $dbUsername = "root";
    private static $dbUserpassword = "";
    
    private static $connection = null;
    
    public static function connect()
    {
        if(self::$connection == null)
        {
            try
            {
              self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName , self::$dbUsername, self::$dbUserpassword);
            //   self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }
        return self::$connection;
    }
    
    public static function disconnect()
    {
        self::$connection = null;
    }

}


function checkInput($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function enregistrerHistorique($conn, $utilisateur_id, $operation, $details) {
    $stmt = $conn->prepare("INSERT INTO historique (utilisateur_id, operation, details) VALUES (?, ?, ?)");
    $stmt->execute( array($utilisateur_id, $operation, $details));
}

?>
