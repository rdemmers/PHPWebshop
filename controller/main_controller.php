<?php

require_once(SERVICE . "service_manager.php");

class MainController {

    public static $pageName;
    private $serviceManager;
    private $isPostRequest;
    private $actionProperty;
    private $typeProperty;

    public function __construct(Crud $crud) {
        $this->serviceManager = new ServiceManager($crud);

        $this->isPostRequest  = (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === "POST");
        $this->actionProperty = filter_input(INPUT_GET, 'action');
        $this->typeProperty   = filter_input(INPUT_POST, 'type');
    }

    public function handleRequests() {
        try {
            if (isset($this->actionProperty) || isset($this->typeProperty)) {
                $this->handleNonPageRequest();
            }

            $this::$pageName = $this->getPage();

            $returnBody = $this->handlePreProcessing();

            $this->handlePageRequest($returnBody);
        } catch (PDOException $e) {
            Logger::_error($e);
            require_once(CONTROLLER . "page_factory.php");
            $this::$pageName = "ERROR";
            $pageFactory     = new PageFactory();
            $pageFactory->prepareRequestedPage("Er ging iets mis in onze database! Excuses voor het ongemak.")->show();
        }
    }

    //==============================================================================================
    //
    //
    //==============================================================================================

    private function handleNonPageRequest() {
        if ($this->actionProperty === "api") {
            require_once(CONTROLLER . "api_controller.php");
            $controller = new ApiController($this->serviceManager->getProductService());
        } else {
            require_once(CONTROLLER . "ajax_controller.php");
            $controller = new AjaxController($this->serviceManager->getRatingService());
        }

        if (isset($controller)) {
            $controller->handle();
            exit;
        }
    }

    private function handlePreProcessing() {
        if ($this->isPostRequest) {
            require_once(CONTROLLER . "post_listener.php");
            $preProcessor = new PostListener($this->serviceManager);
        } else {
            require_once(CONTROLLER . "get_listener.php");
            $preProcessor = new GetListener($this->serviceManager);
        }
        return $preProcessor->handle();
    }

    private function handlePageRequest($returnBody) {
        require_once(CONTROLLER . "page_factory.php");
        $pageFactory = new PageFactory();
        $page        = $pageFactory->prepareRequestedPage($returnBody);
        $page->show();
    }

    private function getPage(): string {
        if ($this->isPostRequest) {
            if (filter_input(INPUT_POST, 'page') != NULL) {
                return strtoupper(filter_input(INPUT_POST, 'page'));
            }
        } else {
            if (filter_input(INPUT_GET, 'page') != NULL) {
                return strtoupper(filter_input(INPUT_GET, 'page'));
            }
        }
        return 'HOME';
    }

}
