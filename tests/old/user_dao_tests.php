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

include_once("../model/user_dao.php");
include_once("testable.php");

class UserDaoWrapper {

    private $testsToRun;

    public function __construct($crud) {
        $this->testsToRun = array();
        $userDao          = new UserDao($crud);
        $this->testsToRun = array(
            new UserDao_Add($userDao),
            new UserDao_delete($userDao)
        );
    }

    public function getTests() {
        return $this->testsToRun;
    }

}

class UserDao_Add extends Testable {

    public static $writtenId;

    public function runTest() {
        $this->testName   = "UserDao Add";
        $this::$writtenId = $this->dao->add("TestGebruiker", "ditiseen@test.com", "12345");

        if (is_numeric($this::$writtenId)) {
            $this->success = true;
        } else {
            $this->errorMessage = "Could not write user to database";
        }
    }

}

class UserDao_delete extends Testable {

    public function runTest() {
        $this->testName = "UserDao delete";
        $result         = $this->dao->delete(UserDao_Add::$writtenId);

        if (is_numeric($result)) {
            $this->success = true;
        } else {
            $this->errorMessage = "Could not remove user from database";
        }
    }

}
