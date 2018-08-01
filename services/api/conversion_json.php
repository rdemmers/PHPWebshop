<?php

require_once(SERVICE . "api/product_conversion_strategy.php");

class ConversionJson implements ProductConversionStrategy {

    public function convertProduct($product) {
        return json_encode($product);
    }

    public function convertProductArr($productArr) {
        return json_encode($productArr);
    }

}
