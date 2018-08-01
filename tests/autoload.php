<?php

define("ROOT", "");
define("CONTROLLER", ROOT . "controller/");
define("SERVICE", ROOT . "services/");
define("VIEW", ROOT . "view/");
define("MODEL", ROOT . "model/");
define("COMPONENT", ROOT . "components/");
define("LOGGER", ROOT . "logger/");
define("EXCEPTION", ROOT . "exceptions/");
define("UTILITY", ROOT . "utils/");


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../model/product.php';
require_once __DIR__ . '/../model/user.php';
require_once __DIR__ . '/../model/product_dao.php';
require_once __DIR__ . '/../model/order_dao.php';
require_once __DIR__ . '/../model/rating_dao.php';
require_once __DIR__ . '/../model/user_dao.php';
require_once __DIR__ . '/../model/single_rating.php';
require_once __DIR__ . '/../utils/assert.php';
require_once __DIR__ . '/../services/product_service.php';
require_once __DIR__ . '/../services/order_service.php';
require_once __DIR__ . '/../services/rating_service.php';
require_once __DIR__ . '/../services/user_service.php';
require_once __DIR__ . '/../controller/page_factory.php';
require_once __DIR__ . '/../controller/main_controller.php';
require_once __DIR__ . '/../logger/logger.php';
