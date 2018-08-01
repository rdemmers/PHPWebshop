<?php

require_once(SERVICE . "api/product_conversion_strategy.php");

class ConversionHtml implements ProductConversionStrategy {

    public function convertProduct($product) {
        return "<div class='shop_product'>"
                . "<div class='shop_product_id'> {$product->getId()} </div>"
                . "<div class='shop_product_name'>{$product->getName()}</div>"
                . "<div class='shop_product_description'>{$product->getDescription()}</div>"
                . "<div class='shop_product_price'>{$product->getPrice()}</div>"
                . "<div class='shop_product_rating'>{$product->getRating()}</div>"
                . "<div class='shop_product_image'>localhost/opdr3/img/{$product->getImage()}</div>"
                . "<div class-'shop_product_link'>/opdr3/index.php?page=webshop&product={$product->getId()}</div>"
                . "</div>";
    }

    public function convertProductArr($productArr) {
        $response = "<div class='shop_product_array'>";

        foreach ($productArr as $product) {
            $response .= $this->convertProduct($product);
        }

        $response .= "</div>";
        return $response;
    }

}
