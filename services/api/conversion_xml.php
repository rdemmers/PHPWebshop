<?php

require_once(SERVICE . "api/product_conversion_strategy.php");

class ConversionXml implements ProductConversionStrategy {

    private $dtd = "<?xml version='1.0'?>"
            . "<!DOCTYPE product ["
            . "<!ELEMENT product (name, description, price, rating, image)>"
            . "<!ATTLIST product id CDATA #REQUIRED>"
            . "<!ELEMENT name (#PCDATA)>"
            . "<!ELEMENT description (#PCDATA)>"
            . "<!ELEMENT price (#PCDATA)>"
            . "<!ELEMENT rating (#PCDATA)>"
            . "<!ELEMENT image (#PCDATA)>"
            . "<!ELEMENT shoppinglink (#PCDATA)>"
            . "]>";

    public function convertProduct($product) {
        $response = $this->dtd . $this->generateXml($product);
        return $response;
    }

    public function convertProductArr($productArr) {
        $response = $this->dtd . "<products>";

        foreach ($productArr as $product) {
            $response .= $this->generateXml($product);
        }

        $response .= "</products>";
        return $response;
    }

    private function generateXml($product) {
        return "<product id='{$product->getId()}'>"
                . "<name>{$product->getName()}</name>"
                . "<description>{$product->getDescription()}</description>"
                . "<price>{$product->getPrice()}</price>"
                . "<rating>{$product->getRating()}</rating>"
                . "<image>localhost/opdr3/img/{$product->getImage()}</image>"
                . "<shoppinglink>/opdr3/index.php?page=webshop&product={$product->getId()}</shoppinglink>"
                . "</product>";
    }

}
