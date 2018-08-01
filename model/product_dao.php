<?php

require_once(MODEL . "product.php");
require_once(MODEL . "i_dao.php");

class ProductDao implements iDao {

    private $crud = null;

    function __construct($crud) {
        $this->crud = $crud;
    }

    function add($product) {

        $query  = "INSERT INTO `products` (`name`, `price`, `image`, description) VALUES (:name, :price, :image, :description)";
        $values = [
            "name"        => $product->getName(),
            "price"       => $product->getPrice(),
            "image"       => $product->getImage(),
            "description" => $product->getDescription()
        ];
        return $this->crud->insert($query, $values);
    }

    function update($product) {
        $query  = "UPDATE `products` SET name=:name, price=:price, image=:image, description= :description WHERE id = :id";
        $values = [
            "name"        => $product->getName(),
            "price"       => $product->getPrice(),
            "image"       => $product->getImage(),
            "description" => $product->getDescription(),
            "id"          => $product->getId()
        ];

        return $this->crud->update($query, $values);
    }

    function delete($id) {
        $query  = "DELETE FROM `products` WHERE id = :id";
        $values = [
            "id" => $id
        ];

        return $this->crud->delete($query, $values);
    }

    function getAll() {
        $query = "SELECT * FROM products";

        $allProducts = $this->crud->selectMultiple($query, null);

        $arrProducts = [];

        foreach ($allProducts as $product) {

            $currentProduct = $this->mapToObject($product);
            $arrProducts[]  = $currentProduct;
        }


        return $arrProducts;
    }

    function get($id) {
        $query  = "SELECT * FROM products where id= :id";
        $values = [
            "id" => $id
        ];

        $productQueryResult = $this->crud->selectOne($query, $values);

        return $this->mapToObject($productQueryResult);
    }

    private function mapToObject($productQueryResult) {

        $product = new Product($productQueryResult["id"], $productQueryResult["name"], $productQueryResult["price"], $productQueryResult["image"], $productQueryResult["description"]);
        if ($product->getId() === null) {
            return false;
        }
        return $product;
    }

}
