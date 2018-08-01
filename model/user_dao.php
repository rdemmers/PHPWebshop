<?php

require_once(MODEL . "user.php");
require_once (MODEL . "i_dao.php");

class UserDao implements iDao {

    private $crud = null;

    function __construct($crud) {
        $this->crud = $crud;
    }

    function checkEmailAvailable($sEmail) {
        $query  = "SELECT email FROM users WHERE email = :email";
        $values = ["email" => $sEmail];

        $emailFound = $this->crud->selectOne($query, $values);

        if ($emailFound) {
            return false;
        }

        return true;
    }

    function add($user) {
        $query  = "INSERT INTO `users` (`id`, `email`, `name`, `password`) VALUES (NULL, :email, :name, :password)";
        $values = [
            "email"    => $user->getEmail(),
            "name"     => $user->getName(),
            "password" => $user->getPassword()
        ];

        return $this->crud->insert($query, $values);
    }

    function get($id) {
        $query  = "SELECT * FROM `users` where id= :id";
        $values = [
            "id" => $id
        ];

        $queryResult = $this->crud->selectOne($query, $values);

        return $this->mapToObject($queryResult);
    }

    function update($user) {
        $query  = "UPDATE `users` SET email=:email, name=:name, password=:password WHERE id = :id";
        $values = [
            "email"    => $user->getEmail(),
            "name"     => $user->getName(),
            "password" => $user->getPassword(),
            "id"       => $user->getId()
        ];

        return $this->crud->update($query, $values);
    }

    function delete($id) {
        $query  = "DELETE FROM `users` WHERE id=:id";
        $values = ["id" => $id
        ];

        return $this->crud->delete($query, $values);
    }

    //check if the email/pasword match the ""database""
    function validateCredentials($sEmail, $sPassword) {
        $query  = "SELECT id, email, name FROM users WHERE email = :email AND password = :password";
        $values = ["email"    => $sEmail,
            "password" => $sPassword
        ];

        $userQueryResult = $this->crud->selectOne($query, $values);

        if (!$userQueryResult) {
            return false;
        } else {
            return $this->mapToObject($userQueryResult);
        }
    }

    private function mapToObject($userQueryResult) {
        return new User($userQueryResult["id"], $userQueryResult["email"], $userQueryResult["name"]);
    }

}
