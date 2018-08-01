<?php

require_once(VIEW . "webshop_htmldoc.php");
require_once(COMPONENT . "form_builder.php");

class WebshopPage extends WebshopHtmlDoc {

    public function renderBody() {
        echo "
				<div id=\"container\"><h2 class='title'> Webshop </h2>
         <h4 class='subtitle'> Goede syntax voor een betaalbare prijs </h4>";

        foreach ($this->returnBody as $product) {

            echo '<div class="card">
           <header class="card-header">
             <p class="card-header-title">
             <a href="?page=webshop&product=';
            echo $product->getId();
            echo '" class="card-footer-item">';
            echo $product->getName();
            echo '</a>
                </p>
             <a href="#" class="card-header-icon" aria-label="more options">
               <span class="icon">
                 <i class="fas fa-angle-down" aria-hidden="true"></i>
               </span>
             </a>
           </header>
           <div class="card-content">
             <div class="content">';
            echo "<img src='../opdr3/img/{$product->getImage()}' />";

            echo '</div>
             </div>
             <footer class="card-footer">
            <a href="#" class="card-footer-item">';
            echo "€{$product->getPrice()}</a>";

            if (isset($_SESSION["user"])) {
                $fB = new FormBuilder("ProductPage", htmlspecialchars($_SERVER["PHP_SELF"]) . "?page=webshop", "post");
                $fB->addHiddenField("id", $product->getId());
                $fB->addHiddenField("page", "webshop");
                $fB->addSubmit("In winkelwagen");
                $fB->display();
            }

            echo '</footer>
       </div>';
        }
    }

}
