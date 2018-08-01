<?php

use PHPUnit\Framework\TestCase;

include_once("pdo_connector_testing.php");
include_once ("crud.php");

class OrderServiceTest extends TestCase {

    private $service;

    function setUp() {

        $crud          = Crud::getCrud();
        $dao           = new OrderDao($crud);
        $this->service = new OrderService($dao);
    }

    public function testAdd() {
        $this->service->add(60, 5);

        $this->assertTrue(isset($_SESSION["cart"]));
    }

    public function testAddOnString() {
        $this->assertFalse($this->service->add("Geen int", 5));
    }

    public function testAddSingle() {
        $this->service->addSingle(40);
        $this->assertTrue(isset($_SESSION["cart"]));
    }

    public function testAddSingleOnString() {
        $this->assertFalse($this->service->addSingle("Ook geen int"));
    }

}
