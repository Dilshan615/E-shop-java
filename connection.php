<?php

class Database{

    public static $connection;

    //DB Connection
    public static function setUpConnection()
    {

        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("localhost" , "root" , "Dilshan123#" , "eshop" , "3306");
        }
    }

    //INSERT , UPDATE , DELETE
    public static function iud($q){
        Database::setUpConnection();
        Database::$connection->query($q);
    }

    //SELECT
    public static function search($q){
        Database::setUpConnection();
        $resultset = Database::$connection->query($q);
        return $resultset;
    }

}

?>
