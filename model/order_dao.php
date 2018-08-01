<?php

require_once (MODEL . "product.php");

// Ik weet niet heel goed wat ik aan moet met deze class met betrekking tot de interface. De standaard functies zijn hier
// namelijk echt overbodig, maar het is wel een DAO class. Is het goed om ze zo te laten?

class OrderDao {

    private $crud = null;

    function __construct($crud) {
        $this->crud = $crud;
    }

    function createOrderEntry() {
        $userId = $_SESSION["user"]->getId();

        $query  = "INSERT INTO `user_order` (`user_id`) VALUES (:user_id)";
        $values = [
            "user_id" => $userId
        ];

        return $this->crud->insert($query, $values);
    }

    function cartToDb($entryId) {
        if (isset($_SESSION["cart"])) {
            $success = false;
            foreach ($_SESSION["cart"] as $id => $quantity) {
                $query            = "INSERT INTO `product_order` (`order_id`, `product_id`, `quantity`) VALUES (:order_id, :product_id, :quantity)";
                $values           = [
                    "order_id"   => $entryId,
                    "product_id" => $id,
                    "quantity"   => $quantity
                ];
                $_SESSION["cart"] = null;

                if (is_numeric($this->crud->insert($query, $values))) {
                    $success = true;
                };
            }

            return $success;
        } else {
            return false;
        }
    }

}
