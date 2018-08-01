<?php

require_once(VIEW . "webshop_htmldoc.php");

class HomePage extends WebshopHtmlDoc {

    public function renderBody() {
        echo "
				<div id=\"container\"><h2> Welkom op deze prachtige website!</h2>
            	<p> Deze pagina is momenteel nog onder constructie. Het is momenteel nog
    niet duidelijk welke service we hier gaan bieden, maar U kunt zich altijd inschrijven voor onze mailing list!</p>";
    }

}
