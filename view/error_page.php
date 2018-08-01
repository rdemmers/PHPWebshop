<?php

require_once(VIEW . "webshop_htmldoc.php");

class ErrorPage extends WebshopHtmlDoc {

    public function renderBody() {
        echo "<h1>Database Error</h1>";
        echo $this->returnBody;
    }

}
