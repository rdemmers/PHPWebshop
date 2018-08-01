<?php

interface productConversionStrategy {

    public function convertProduct($product);

    public function convertProductArr($productArr);
}
