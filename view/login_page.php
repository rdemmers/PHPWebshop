<?php

require_once(VIEW . "webshop_htmldoc.php");
require_once(COMPONENT . "form_builder.php");

class LoginPage extends WebshopHtmlDoc {

    public function renderBody() {
        echo "<div id=\"container\"><h2>Log in</h2>";

        $fB = new FormBuilder("contact_form", htmlspecialchars($_SERVER["PHP_SELF"]) . "?page=login", "post");
        $fB->addField("Email:", "text", "email", NULL);
        $fB->addField("Wachtwoord:", "password", "password", NULL);
        $fB->addHiddenField("page", "login");
        $fB->addSubmit("Verzenden");
        $fB->display();
    }

}
