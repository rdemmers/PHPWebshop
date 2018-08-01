<?php

class SingleRating {

    private $id;
    private $userId;
    private $productId;
    private $rating;

    public function __construct($id, $userId, $productId, $rating) {
        $this->userId    = $userId;
        $this->productId = $productId;
        $this->rating    = $rating;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function getRating() {
        return $this->rating;
    }

}
