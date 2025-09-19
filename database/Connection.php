<?php

namespace Database;

use PDO;
use PDOException;

class Connection
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    "mysql:host=localhost;dbname=aeropuerto;charset=utf8",
                    "root",
                    "sandbox"
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}


//php -S localhost:8000 -t .
