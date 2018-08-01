<?php

require(VIEW . "htmldoc.php");

abstract class WebshopHtmlDoc extends HtmlDoc {

    protected $returnBody;

    function __construct($returnBody) {
        $this->returnBody = $returnBody;
        $this->setTitle(MainController::$pageName);
        $this->addStylesheet("bulma");
        $this->addStylesheet("style");
    }

    protected function renderNavigation() {
        // set pages to be displayed in menu
        $arrPages = array("home", "about", "contact", "webshop");
        // Show login/register for user without a session
        if (!isset($_SESSION["user"])) {
            array_push($arrPages, "login", "register");
        }

        echo "<div class=\"menu\"><ul>";

        foreach ($arrPages as $sPage) {
            echo "<li><a href=\"../project/index.php?page=" . $sPage . "\">" . $sPage . "</a></li>";
        }

        // Show a log out button if the user is logged in
        if (isset($_SESSION["user"])) {
            echo "<li><a href=\"../project/index.php?page=logout\"> Logout " . $_SESSION["user"]->getName() . "</a></li>";
            echo "<li><a href=\"../project/index.php?page=cart\"> Shopping Cart</a></li>";
        }
        echo "</ul></div>";
    }

    protected function renderBody() {
        // TODO: Implement getBody() method.
    }

    protected function renderFooter() {

        echo "</div>
			<footer>&#169; Roy Demmers 2018</footer>
			</body>
			</html>";
    }

}
