<?php

require_once(MODEL . "order_dao.php");

class OrderService {

    private $orderDao;

    function __construct(OrderDao $orderDao) {

        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();
        }

        $this->orderDao = $orderDao;
    }

    public function add($id, $quantity) {
        try {
            Assert::isNumeric($id, $quantity);

            if (!isset($_SESSION["cart"])) {
                $_SESSION["cart"] = [];
            }

            $cart = $_SESSION["cart"];

            if (isset($cart[$id])) {
                $cart[$id] += 1;
            } else {
                $cart[$id] = $quantity;
            }

            $_SESSION["cart"] = $cart;
            return true;
        } catch (InvalidArgumentException $e) {
            Logger::_error($e);
            return false;
        }
    }

    function sessionToDb() {
        $entryId = $this->orderDao->createOrderEntry();
        $this->orderDao->cartToDb($entryId);
    }

    function addSingle($id) {
        try {
            Assert::isNumeric($id);
            return $this->add($id, 1);
        } catch (InvalidArgumentException $e) {
            Logger::_error($e);
            return false;
        }
    }

}
