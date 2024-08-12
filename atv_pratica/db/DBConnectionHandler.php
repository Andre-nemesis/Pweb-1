<?php

namespace db;

use mysqli;
use Exception;

class DBConectionHandler{
    private static string $host = "127.0.0.1:3306";
    private static string $db_name = "db_teste";
    private static string $user = "andre";
    private static string $password = "andre";
    private static mysqli $connection_handler;

    public function __construct(){
        self::$connection_handler = new mysqli(self::$host, self::$user, self::$password,self::$db_name);
    }

    public function getConnection():mysqli{
        if (self::$connection_handler->connect_error){
            die("Connection failed: ".self::$connection_handler->connect_error);
        }
        else{
            return self::$connection_handler;
        }
    }

    public function closeConnection(){
        try{
            self::$connection_handler->close();
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        
    }
}
?>