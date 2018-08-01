<?php

class User {

    private $id;
    private $email;
    private $name;
    private $password;

    public function __construct($id, $email, $name) {
        $this->id    = $id;
        $this->email = $email;
        $this->name  = $name;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getName() {
        return $this->name;
    }

    public function getPassword() {
        return $this->password;
    }

}
