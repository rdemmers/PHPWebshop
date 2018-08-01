<?php

class Product implements JsonSerializable {

    private $id;
    private $name;
    private $price;
    private $image;
    private $description;
    private $quantity;
    private $rating;

    public function __construct($id, $name, $price, $image, $description) {
        $this->id          = $id;
        $this->name        = $name;
        $this->price       = $price;
        $this->image       = $image;
        $this->description = $description;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getRating() {
        return $this->rating;
    }

    function setRating($rating) {
        $this->rating = $rating;
    }

    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }

}
