<?php

require_once(SERVICE . "product_service.php");
require_once(MODEL . "product_dao_tests.php");

require_once(CONTROLLER . "i_controller.php");

class ApiController implements iController {

    private $conversionStrategy;
    private $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function handle() {
        $productId = filter_input(INPUT_GET, 'product');

        $this->setConversionStrategy(filter_input(INPUT_GET, 'type'));

        try {
            if ($productId === null) {
                $this->echoAllProductsResponse();
            } else {
                $this->echoSingleProductResponse($productId);
            }
        } catch (Throwable $e) {
            Logger::_echo($e->getMessage());
            http_response_code(400);
            echo "Bad request. Please make sure your parameters are correct";
        }
    }

    private function setConversionStrategy($type) {
        switch ($type) {
            case "html":
                $this->prepareHtmlResponse();
                break;
            case "json":
                $this->prepareJsonResponse();
                break;
            case "xml":
                $this->prepareXmlResponse();
                break;
        }
    }

    private function prepareHtmlResponse() {
        include_once(SERVICE . "api/conversion_html.php");
        $this->conversionStrategy = new ConversionHtml();
    }

    private function prepareJsonResponse() {
        include_once(SERVICE . "api/conversion_json.php");
        header('Content-Type: application/json');
        $this->conversionStrategy = new ConversionJson();
    }

    private function prepareXmlResponse() {
        include_once(SERVICE . "api/conversion_xml.php");
        header('Content-Type: application/xml');
        $this->conversionStrategy = new ConversionXml();
    }

    private function echoSingleProductResponse($productId) {
        $product  = $this->productService->get($productId);
        $response = $this->conversionStrategy->convertProduct($product);

        echo $response;
    }

    private function echoAllProductsResponse() {
        $productArr = $this->productService->getAll();
        $response   = $this->conversionStrategy->convertProductArr($productArr);

        echo $response;
    }

}
