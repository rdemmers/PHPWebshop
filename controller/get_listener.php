<?php

require_once(ROOT . "logger/logger.php");
require_once(MODEL . "total_rating.php");
require_once(CONTROLLER . "i_controller.php");

class GetListener implements iController {

    private $productService;
    private $ratingService;

    public function __construct(ServiceManager $serviceManager) {
        $this->productService = $serviceManager->getProductService();
        $this->ratingService  = $serviceManager->getRatingService();
    }

    function handle() {
        switch (MainController::$pageName) {
            case "LOGOUT":
                $this->handleLogout();
                break;
            case "WEBSHOP":
                return $this->handleWebshop();
            case "CART":
                return $this->productService->cartToProductsArr();
        }

        return null;
    }

    private function handleWebshop() {
        $productId = filter_input(INPUT_GET, 'product');
        if ($productId !== NULL) {
            return $this->productService->get($productId);
        } else {
            return $this->productService->getAll();
        }
    }

    private function handleLogout() {
        unset($_SESSION["user"]);
        $_GET['page'] = "";
    }

}
