<?php

require_once(CONTROLLER . "i_controller.php");

class PostListener implements iController {

    private $userService;
    private $productService;
    private $orderService;

    public function __construct(ServiceManager $serviceManager) {
        $this->userService    = $serviceManager->getUserService();
        $this->productService = $serviceManager->getProductService();
        $this->orderService   = $serviceManager->getOrderService();
    }

    function handle() {
        switch (MainController::$pageName) {
            case "LOGIN":
                $this->userService->validateAndLogin();
                break;
            case "REGISTER":
                MainController::$pageName = "HOME";
                return $this->handleRegister();
            case "CONTACT":
                return $this->handleContact();
            case "WEBSHOP":
                $this->orderService->add(filter_input(INPUT_POST, 'id'), 1);
                return $this->productService->getAll();
            case "CART":
                $this->orderService->sessionToDb();
                break;
        }

        return null;
    }

    private function handleRegister() {
        require_once(SERVICE . "form_validator.php");
        $formValidator = new FormValidator();

        $result = $formValidator->validateRegistrationForm();

        if (get_class($result) == "user") {
            return $this->userService->handleRegistration($result);
        } else {
            return $result;
        }
    }

    private function handleContact() {
        require_once(SERVICE . "form_validator.php");
        $formValidator = new FormValidator();
        $bHasErrors    = $formValidator->validateAndHandleContact();
        if (isset($bHasErrors)) {
            return $bHasErrors;
        }
    }

}
