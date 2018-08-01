<?php

require_once(VIEW . "webshop_htmldoc.php");
require_once(MODEL . "product.php");
require_once(COMPONENT . "form_builder.php");

class ShoppingcartPage extends WebshopHtmlDoc {

    public function renderBody() {

        echo '<div id="container">
                <table class="table is-fullwidth">
                <thead>
                  <tr>
                    <th>Productnaam</th>
                    <th>Prijs</th>
                    <th>Hoeveelheid</th>
                  </tr>
                </thead>
                <tbody>';

        if (isset($this->returnBody)) {
            foreach ($this->returnBody as $product) {
                echo '<tr>';
                echo "<td>{$product->getName()}</td>";
                echo "<td>{$product->getPrice()}</td>";
                echo "<td>{$product->getQuantity()}</td>";
                echo '</tr>';
            }
        }

        echo '</tbody>
              </table>';

        $fB = new FormBuilder(NULL, htmlspecialchars($_SERVER["PHP_SELF"]) . "?page=home", "post");
        $fB->addHiddenField("page", "cart");
        $fB->addSubmit("Afrekenen");
        $fB->display();
    }

}
