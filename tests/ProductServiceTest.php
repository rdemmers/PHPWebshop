<?php

use PHPUnit\Framework\TestCase;

include_once("pdo_connector_testing.php");
include_once ("crud.php");

class ProductServiceTest extends TestCase {

    private $service;

    function setUp() {

        $crud          = Crud::getCrud();
        $dao           = new ProductDao($crud);
        $this->service = new ProductService($dao);
    }

    public function testAdd() {
        $product = new Product(null, "Testproduct", "12,20", "test.jpg", "omschrijving");

        $id = $this->service->add($product);
        $this->assertTrue(is_numeric($id));
        return $id;
    }

    /**
     * @expectedException     TypeError
     *
     */
    public function testAddWithoutProduct() {
        $notAProduct = ["hoi", 777, 8000];
        $this->assertFalse($this->service->add($notAProduct));
    }

    /**
     * @expectedException     PDOException
     *
     */
    public function testAddInvalidProperty() {
        $product = new Product(null, "Testproduct", "12,20;alkjf;aljfjladkjdfkjfdk", "test.jpg", "omschrijving");

        $id = $this->service->add($product);
    }

    /**
     * @depends testAdd
     */
    public function testDelete($id) {

        $result = $this->service->delete($id);

        $this->assertTrue($result == 1);
    }

    public function testDeleteOnString() {
        $this->assertFalse($this->service->delete("Dit is geen int natuurlijk"));
    }

    public function testGet() {
        $product = $this->service->get(1);

        $this->assertInstanceOf("Product", $product);
    }

    public function testGetOnString() {
        $this->assertFalse($this->service->get("Geen int"));
    }

    public function testGetOnMissingId() {
        $this->assertFalse($this->service->get(9999999));
    }

    public function testGetAll() {
        $array = $this->service->getAll();
        $this->assertInternalType('array', $array);
        $first = $array[0];
        $this->assertInstanceOf("Product", $first);
    }

}
