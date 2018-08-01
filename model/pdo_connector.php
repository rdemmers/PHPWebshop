<?php

abstract class PDOConnector {

    private static $pdo = null;

    public static function getPdo() {

        if (isset(self::$pdo)) {
            return self::$pdo;
        } else {
            try {
                $host    = '127.0.0.1';
                $db      = 'educom_webshop';
                $user    = 'root';
                $pass    = 'educom';
                $charset = 'utf8mb4';

                $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
                $opt = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];


                self::$pdo = new PDO($dsn, $user, $pass, $opt);

                return self::$pdo;
            } catch (Exception $e) {

                //Logger::_echo($e->getMessage());
                echo $e;
                echo "Something went wrong with establishing a database connection!<br />";
                echo "The PDO Gnomes are working as fast as possible to fix this issue!";
                http_response_code(500);
                exit;
            }
        }
    }

}
