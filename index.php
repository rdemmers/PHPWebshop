<?php

require_once("../project/model/user.php");
session_start();


define("ROOT", "../project/");
define("CONTROLLER", ROOT . "controller/");
define("SERVICE", ROOT . "services/");
define("VIEW", ROOT . "view/");
define("MODEL", ROOT . "model/");
define("COMPONENT", ROOT . "components/");
define("LOGGER", ROOT . "logger/");
define("EXCEPTION", ROOT . "exceptions/");
define("UTILITY", ROOT . "utils/");

require_once (CONTROLLER . "main_controller.php");
require_once (MODEL . "crud.php");
require_once (LOGGER . "logger.php");
require_once (UTILITY . "assert.php");

$crud           = Crud::getCrud();
$mainController = new MainController($crud);

$mainController->handleRequests();
