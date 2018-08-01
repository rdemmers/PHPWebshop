<?php

abstract class PDOConnectorTest {

    private static $pdo = null;

    public static function getPdo() {

        if (isset(self::$pdo)) {
            return self::$pdo;
        } else {
            try {
                $host    = '127.0.0.1';
                $db      = 'educom_tests';
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
            } catch (PDOException $e) {


                http_response_code(500);
                echo "Something went wrong with establishing a database connection!<br />";
                echo "The PDO Gnomes are working as fast as possible to fix this issue!";
                exit;
            }
        }
    }

}
