<?php

require_once("../model/user.php");
session_start();

define("ROOT", "../");
define("CONTROLLER", ROOT . "controller/");
define("SERVICE", ROOT . "services/");
define("VIEW", ROOT . "view/");
define("MODEL", ROOT . "model/");
define("COMPONENT", ROOT . "components/");
define("LOGGER", ROOT . "logger/");

include_once("crud.php");


include_once("pdo_connector_testing.php");


include_once("product_dao_tests.php");
include_once("user_dao_tests.php");
include_once("order_dao_tests.php");


$pdo  = PDOConnectorTest::getPdo();
$crud = Crud::getCrud();


$wrapperProduct = new ProductDaoWrapper($crud);
$productTests   = $wrapperProduct->getTests();

$wrapperUser = new UserDaoWrapper($crud);
$userTests   = $wrapperUser->getTests();

$wrapperOrder = new OrderDaoWrapper($crud);
$orderTests   = $wrapperOrder->getTests();

$tests = array_merge($productTests, $userTests, $orderTests);



$failed = 0;
$total  = 0;
foreach ($tests as $test) {
    $test->runTest();
    $results = $test->getResult();

    echo "<h2> Test done: {$results["testName"]}</h2>";
    echo "Test = {$results["success"]} <br />";
    if (!$results["success"]) {
        echo $results["errorMessage"] . "<br /><br />";
        $failed++;
    }
    $total++;
}

echo "<br /> Total tests done: {$total} <br />Tests failed: {$failed}";





