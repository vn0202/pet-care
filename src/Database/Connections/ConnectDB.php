<?php
namespace Vannghia\PetCare\Database\Connections;

use PDO;

class ConnectDB {
    public static function connect(){
        // $config = require "./config.php";
        try {
            // if ($config['driver'] === "mysql") {
                $conn  = new PDO("mysql:host=127.0.0.1;dbname=pet_care",'root',"root");
                // $conn =  new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['username'], $config['password']);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;

            // }

        } catch (\PDOException $e) {
            echo "Connect fail....";
        }

    }
}