<?php

require_once(MODEL . "i_dao.php");

class RatingDao implements iDao {

    private $crud = null;

    function __construct($crud) {
        $this->crud = $crud;
    }

    /**
     *
     * @param $id The $id of the product
     * @return The average rating of a given product
     */
    function get($id) {
        $query  = "SELECT AVG(rating) FROM product_rating WHERE product_id= :id";
        $values = [
            "id" => $id
        ];

        return $this->crud->selectSingleValue($query, $values);
    }

    function update($singleRating) {
        $query  = "UPDATE `product_rating` SET user_id= :userId, product_id= :productId, rating= :rating WHERE id = :id";
        $values = [
            "userId"    => $singleRating->getUserId(),
            "productId" => $singleRating->getProductId(),
            "rating"    => $singleRating->getRating()
        ];

        return $this->crud->update($query, $values);
    }

    function getNumberVotes($id) {
        $query  = "SELECT COUNT(*) FROM product_rating WHERE product_id= :id";
        $values = [
            "id" => $id
        ];

        return $this->crud->selectSingleValue($query, $values);
    }

    function hasUserVoted($singleRating): bool {
        $query  = "SELECT COUNT(*) FROM product_rating WHERE product_id= :product_id AND user_id= :user_id";
        $values = [
            "product_id" => $singleRating->getProductId(),
            "user_id"    => $singleRating->getUserId()
        ];

        return $this->crud->selectSingleValue($query, $values) > 0 ? true : false;
    }

    function delete($id) {
        $query  = "DELETE FROM `product_rating` WHERE id = :id";
        $values = [
            "id" => $id
        ];

        return $this->crud->delete($query, $values);
    }

    function add($singleRating) {
        $query  = "INSERT INTO product_rating (`user_id`, `product_id`, `rating`) VALUES (:user_id, :product_id, :rating)";
        $values = [
            "product_id" => $singleRating->getProductId(),
            "user_id"    => $singleRating->getUserId(),
            "rating"     => $singleRating->getRating()
        ];

        return $this->crud->insert($query, $values);
    }

}
