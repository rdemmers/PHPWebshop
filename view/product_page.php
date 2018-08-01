<?php

require_once(VIEW . "webshop_htmldoc.php");
require_once(COMPONENT . "form_builder.php");
require_once(COMPONENT . "star_rating.php");

class ProductPage extends WebshopHtmlDoc {

    function __construct($returnBody) {
        parent::__construct($returnBody);

        // add css for the rating widget
        parent::addStylesheet("components/rating_style");
    }

    public function renderBody() {

        echo "<div id=\"container\"><h2 class='title'> {$this->returnBody->getName()} </h2>
         <h4 class='subtitle'> Goede syntax voor een betaalbare prijs </h4>";

        echo '<div class="card">
              <div class="card-image">
                <figure class="image is-2by2">';
        echo "<img src='../opdr3/img/big{$this->returnBody->getImage()}' />";

        echo '</figure>
              </div>
              <div class="card-content">
                <div class="media">
                  <div class="media-left">
                    <figure class="image is-48x48">';

        echo "<img src='../opdr3/img/{$this->returnBody->getImage()}' />";
        echo '</figure>
                  </div>
                  <div class="media-content">';
        echo "<p class='title is-4'>{$this->returnBody->getName()}</p>";
        echo '</div>
                </div>
            
                <div class="content">';
        echo $this->returnBody->getDescription();

        if (isset($_SESSION["user"])) {
            new StarRating($this->returnBody->getId());
        }

        $fB = new FormBuilder("ProductPage", htmlspecialchars($_SERVER["PHP_SELF"]) . "?page=webshop", "post");
        $fB->addHiddenField("id", $this->returnBody->getId());
        $fB->addHiddenField("page", "webshop");
        $fB->addSubmit("In winkelwagen");
        $fB->display();


        echo '
                </div>
              </div>
            </div>';
    }

    protected function renderFooter() {
        echo "<script src='";
        echo COMPONENT . "js/rating_script.js'";
        echo "></script>";
        echo "</div>
			<footer>&#169; Roy Demmers 2018</footer>
			</body>
			</html>";
    }

}
