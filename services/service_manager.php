<?php

class ServiceManager {

    private $crud;
    private $orderService   = null;
    private $productService = null;
    private $userService    = null;
    private $ratingService  = null;

    function __construct($crud) {
        $this->crud = $crud;
    }

    function getOrderService() {
        require_once (SERVICE . "order_service.php");
        require_once (MODEL . "order_dao.php");

        if ($this->orderService == null) {
            $orderDao           = new OrderDao($this->crud);
            $this->orderService = new OrderService($orderDao);
        }

        return $this->orderService;
    }

    function getProductService() {
        require_once (SERVICE . "product_service.php");
        require_once (MODEL . "product_dao.php");

        if ($this->productService == null) {
            $productDao           = new ProductDao($this->crud);
            $this->productService = new ProductService($productDao);
        }

        return $this->productService;
    }

    function getRatingService() {
        require_once (SERVICE . "rating_service.php");
        require_once (MODEL . "rating_dao.php");

        if ($this->ratingService == null) {
            $ratingDao           = new RatingDao($this->crud);
            $this->ratingService = new RatingService($ratingDao);
        }

        return $this->ratingService;
    }

    function getUserService() {
        require_once (MODEL . "user_dao.php");
        require_once (SERVICE . "user_service.php");
        if ($this->userService == null) {
            $userDao           = new UserDao($this->crud);
            $this->userService = new UserService($userDao);
        }

        return $this->userService;
    }

}
