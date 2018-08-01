<?php

session_start();

use PHPUnit\Framework\TestCase;

include_once("pdo_connector_testing.php");
include_once ("crud.php");

class UserServiceTest extends TestCase {

    private $service;

    function setUp() {

        $crud          = Crud::getCrud();
        $dao           = new UserDao($crud);
        $this->service = new UserService($dao);
    }

}
