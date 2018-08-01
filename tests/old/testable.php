<?php

abstract class Testable {

    protected $testName;
    protected $success = false;
    protected $errorMessage;
    protected $dao;

    public function __construct($dao) {
        $this->dao = $dao;
    }

    public function getResult() {

        if ($this->success) {
            $success = "Successful!";
        } else {
            $success = "Failure";
        }
        return array(
            "testName"     => $this->testName,
            "success"      => $success,
            "errorMessage" => $this->errorMessage
        );
    }

    public abstract function runTest();
}
