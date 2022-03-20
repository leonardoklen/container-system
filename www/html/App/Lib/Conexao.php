<?php

namespace App\Lib;

use Exception;
use PDO;
use PDOException;

class Conexao
{
    private static $connection;

    private function __construct()
    {
    }

    public static function getConnection()
    {
        $pdoConfig = DB_DRIVER . ":" . "host=" . DB_HOST . ";";
        $pdoConfig .= "dbname=" . DB_NAME . ";";

        try {
            if (!isset(self::$connection)) {
                self::$connection = new PDO(
                    $pdoConfig,
                    DB_USER,
                    DB_PASSWORD,
                    array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_PERSISTENT => false,
                        PDO::ATTR_EMULATE_PREPARES => false,
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    )
                );
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$connection;
        } catch (PDOException $e) {
            throw new Exception("Erro de conexão com o banco de dados " . $e->getMessage(), 500);
        }
    }
}
