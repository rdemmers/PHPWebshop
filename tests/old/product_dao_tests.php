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

include_once("../model/product_dao.php");
include_once("testable.php");

class ProductDaoWrapper {

    private $testsToRun;

    public function __construct($crud) {
        $this->testsToRun = array();
        $productDao       = new ProductDao($crud);
        $this->testsToRun = array(new ProductDao_Add($productDao),
            new ProductDao_get($productDao),
            new ProductDao_delete($productDao),
            new ProductDao_getAll($productDao),
            new ProductDao_castVote($productDao),
            new ProductDao_getRating($productDao),
            new ProductDao_getNumberVotes($productDao),
            new ProductDao_hasUserVoted($productDao)
        );
    }

    public function getTests() {
        return $this->testsToRun;
    }

}

class ProductDao_Add extends Testable {

    public static $writtenId;

    public function runTest() {
        $this->testName   = "ProductDao Add";
        $product          = new Product(null, "Testproduct", "12,20", "test.jpg", "omschrijving");
        $this::$writtenId = $this->dao->add($product);

        if (is_numeric($this::$writtenId)) {
            $this->success = true;
        } else {
            $this->errorMessage = "Could not write product to database";
        }
    }

}

class ProductDao_get extends Testable {

    public function runTest() {
        $this->testName = "ProductDao Get";
        $result         = $this->dao->get(ProductDao_Add::$writtenId);
        if ($result->getName() == "Testproduct") {
            $this->success = true;
        } else {
            $this->errorMessage = "Could not hryproduct from database";
        }
    }

}

class ProductDao_delete extends Testable {

    public function runTest() {
        $this->testName = "ProductDao Delete";
        $result         = $this->dao->delete(ProductDao_Add::$writtenId);

        if ($result == 1) {
            $this->success = true;
        } else {
            $this->errorMessage = "Could not delete product from database";
        }
    }

}

class ProductDao_getAll extends Testable {

    public function runTest() {
        $this->testName = "ProductDao Get All";
        $result         = $this->dao->getAll();
        if (get_class($result[0]) === "Product") {
            $this->success = true;
        } else {
            $this->errorMessage = "Could not get all products from database";
        }
    }

}

class ProductDao_castVote extends Testable {

    public function runTest() {
        $this->testName = "ProductDao Cast Vote";
        $result         = $this->dao->castVote(777, 1, 5);


        if (is_numeric($result)) {
            $this->success = true;
        } else {
            $this->errorMessage = "Could not add vote to database";
        }
    }

}

class ProductDao_getRating extends Testable {

    public function runTest() {
        $this->testName = "ProductDao Get Rating";

        $result = $this->dao->getRating(1);

        if ($result > 0) {
            $this->success = true;
        } else {
            $this->errorMessage = "Could not get rating from the database";
        }
    }

}

class ProductDao_getNumberVotes extends Testable {

    public function runTest() {
        $this->testName = "ProductDao Number Votes";

        $result = $this->dao->getNumberVotes(1);

        if ($result > 0) {
            $this->success = true;
        } else {
            $this->errorMessage = "Could not get the amount of votes from the database";
        }
    }

}

class ProductDao_hasUserVoted extends Testable {

    public function runTest() {
        $this->testName = "ProductDao has user voted";

        $result = $this->dao->hasUserVoted(1, 777);

        if ($result) {
            $this->success = true;
        } else {
            $this->errorMessage = "Could not check if the user has voted on the product";
        }
    }

}
