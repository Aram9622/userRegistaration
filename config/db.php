<?php
namespace config;
use PDO;

class DbConfig {
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB_PORT = '3308';
    const DB_NAME = 'user_registration';
    public static function connect(){
        $servername = self::DB_HOST;
        $username = self::DB_USER;
        $password = self::DB_PASSWORD;
        $port = self::DB_PORT;
        $dbName = self::DB_NAME;


        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbName;port=$port", $username, $password);
            // set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}


?>