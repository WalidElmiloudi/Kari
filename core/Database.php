<?php

namespace Core;

use PDO;

final class Database
{
    private static ?PDO $instance = null;

    private function __construct(){}

    public static function getInstance(): PDO
    {
        if(self::$instance === null){
            $config = require __DIR__.'/../config/database.php';
            try{
                self::$instance = new PDO("mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}",
                                          "{$config['user']}",
                                          "{$config['password']}",
                                          [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            }catch(PDOException $error){
                echo "failed to connect to database".$error->getMessage();
            }
        }
        return self::$instance;
    }
}