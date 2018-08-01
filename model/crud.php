<?php

require_once(MODEL . "pdo_connector.php");

class Crud {

    private $pdo;
    private static $crud = null;

    private function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public static function getCrud() {
        if (isset(self::$crud)) {
            return self::$crud;
        } else {
            return new Crud(PDOConnector::getPdo());
        }
    }

    public function delete($query, $assArrValues) {

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($assArrValues);
        } catch (PDOException $e) {
            $this->showDatabaseException($e);
        }

        if ($stmt->rowCount() > 0) {
            return $stmt->rowCount();
        } else {
            return false;
        }
    }

    public function update($query, $assArrValues) {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($assArrValues);
        } catch (PDOException $e) {
            $this->showDatabaseException($e);
        }

        if ($stmt->rowCount() > 0) {
            return $stmt->rowCount();
        } else {
            return false;
        }
    }

    public function insert($query, $assArrValues) {
        try {
            $stmt    = $this->pdo->prepare($query);
            $success = $stmt->execute($assArrValues);
        } catch (PDOException $e) {
            echo "exception triggered";
            $this->showDatabaseException($e);
        }

        if ($success) {
            return (int) $this->pdo->lastInsertId();
        } else {
            return false;
        }
    }

    public function selectOne($query, $assArrValues) {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($assArrValues);
        } catch (PDOException $e) {
            $this->showDatabaseException($e);
        }
        //fetch() returns false on failure
        return $stmt->fetch();
    }

    public function selectMultiple($query, $assArrValues) {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($assArrValues);
        } catch (PDOException $e) {
            $this->showDatabaseException($e);
        }
        //fetchAll() returns false on failure
        return $stmt->fetchAll();
    }

    public function selectSingleValue($query, $assArrValues) {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($assArrValues);
        } catch (PDOException $e) {
            $this->showDatabaseException($e);
        }
        //fetchColumn() returns false on failure
        return $stmt->fetchColumn();
    }

    private function showDatabaseException(Exception $e) {
        Logger::_error($e);
        http_response_code(500);
        throw new PDOException("Er ging iets mis in onze database! Excuses voor het ongemak.");
    }

}
