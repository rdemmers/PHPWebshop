<?php

require_once(VIEW . "webshop_htmldoc.php");
require_once(COMPONENT . "form_builder.php");

class RegisterPage extends WebshopHtmlDoc {

    public function renderBody() {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            $this->renderRegisterForm($this->initializeForm());
        } else if (isset($this->returnBody)) {
            // Rerender the form with errors/values if the form wasn't valid.
            $this->renderRegisterForm($this->returnBody);
        }
    }

    function initializeForm() {
        $previouslyFilled = array("sName" => "", "sEmail" => "", "sMessage" => "", "sError" => "");

        return $previouslyFilled;
    }

    function renderRegisterForm($previouslyFilled) {
        echo "<div id=\"container\"><h2> Registeren </h2>";

        $fB = new FormBuilder("contact_form", htmlspecialchars($_SERVER["PHP_SELF"]) . "?page=register", "post");
        $fB->addField("Naam:", "text", "name", $previouslyFilled["sName"]);
        $fB->addField("Email:", "text", "email", $previouslyFilled["sEmail"]);
        $fB->addField("Wachtwoord:", "password", "password", NULL);
        $fB->addField("Herhaal Wachtwoord", "password", "password_repeat", NULL);
        $fB->addHiddenField("page", "register");
        $fB->addSubmit("Verzenden");
        $fB->display();

        echo "<h2>{$previouslyFilled["sError"]}</h2>";
        ;
    }

}
