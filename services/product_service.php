<?php

require_once(MODEL . "product_dao.php");

class ProductService {

    private $productDao;

    function __construct(ProductDao $productDao) {
        $this->productDao = $productDao;
    }

    function add(Product $product) {
        return $this->productDao->add($product);
    }

    function delete($id) {
        try {
            Assert::isNumeric($id);

            return $this->productDao->delete($id);
        } catch (InvalidArgumentException $e) {
            Logger::_error($e);
            return false;
        }
    }

    function get($id) {
        try {
            Assert::isNumeric($id);
            $product = $this->productDao->get($id);

            // If product can't be found on ID, return false 
            if (!$product) {
                return false;
            }
            return $product;
        } catch (InvalidArgumentException $e) {
            Logger::_error($e);
            return false;
        }
    }

    function getAll() {
        return $this->productDao->getAll();
    }

    function cartToProductsArr() {

        $products = array();

        if (isset($_SESSION["cart"])) {
            foreach ($_SESSION["cart"] as $id => $quantity) {
                $product = $this->get($id);

                $product->setQuantity($quantity);
                $products[] = $product;
            }

            return $products;
        }

        return false;
    }

}
