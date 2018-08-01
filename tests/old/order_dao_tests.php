<?php

/*
  class ProductDao extends Testable
  {

  public function runTest()
  {
  $this->testName = "";

  if(){
  $this->success = true;
  } else {
  $this->errorMessage = "";
  }
  }


  }
 */

include_once("../model/order_dao.php");
include_once("testable.php");

class OrderDaoWrapper {

    private $testsToRun;

    public function __construct($crud) {
        $this->testsToRun = array();
        $dao              = new OrderDao($crud);
        $this->testsToRun = array(
            new OrderDao_createOrderEntry($dao),
            new OrderDao_cartToDb($dao)
        );
    }

    public function getTests() {
        return $this->testsToRun;
    }

}

class OrderDao_createOrderEntry extends Testable {

    public static $writtenId;

    public function runTest() {
        $user             = new User(777, "testtest", "test");
        $_SESSION["user"] = $user;
        $this->testName   = "OrderDao create order entry";
        $this::$writtenId = $this->dao->createOrderEntry();

        if (is_numeric($this::$writtenId)) {
            $this->success = true;
        } else {
            $this->errorMessage = "Could not write order entry";
        }
    }

}

class OrderDao_cartToDb extends Testable {

    public function runTest() {

        $_SESSION["cart"] = array(1 => 1, 2 => 2, 3 => 3);
        $_SESSION["user"] = $user;


        $this->testName = "OrderDao write cart to DB";

        $result = $this->dao->cartToDb(OrderDao_createOrderEntry::$writtenId);

        if ($result) {
            $this->success = true;
        } else {
            $this->errorMessage = "Could not write order to database";
        }
    }

}
