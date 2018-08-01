<?php

require_once(VIEW . "webshop_htmldoc.php");
require_once (COMPONENT . "form_builder.php");

class ContactPage extends WebshopHtmlDoc {

    public function renderBody() {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            // Show an empty form if the page is visited from url
            $this->renderContactForm($this->initializeForm());
        } else if (isset($returnBody)) {
            // If there is a returnbody with errors/filled field,
            // render form with errors/values
            $this->renderContactForm($this->returnBody);
        } else {
            $this->renderContactResults();
        }
    }

    private function initializeForm() {

        $previouslyFilled = array("sName" => "", "sEmail" => "", "sMessage" => "");
        $error            = array("sName" => "", "sEmail" => "", "sMessage" => "");

        $values = array("previouslyFilled" => $previouslyFilled, "error" => $error);

        return $values;
    }

    private function renderContactForm($values) {

        echo "<div id=\"container\"><h2>Contact</h2>";

        $fB = new FormBuilder("contact_form", htmlspecialchars($_SERVER["PHP_SELF"]) . "?page=contact", "post");

        $fB->addFieldWithError("Naam:", "text", "name", $values["previouslyFilled"]["sName"], "error", $values["error"]["sName"]);
        $fB->addFieldWithError("Email:", "text", "email", $values["previouslyFilled"]["sEmail"], "error", $values["error"]["sEmail"]);
        $fB->addFieldWithError("Bericht:", "textarea", "message", $values["previouslyFilled"]["sMessage"], "error", $values["error"]["sMessage"]);
        $fB->addHiddenField("page", "contact");
        $fB->addSubmit("Verzenden");
        $fB->display();
    }

    private function renderContactResults() {
        echo "<body>
		<div id=\"container\">
                <li>naam: " . $_POST["name"] . "</li>";
        echo "<li>naam: " . $_POST["email"] . "</li>";
        echo "<li>naam: " . $_POST["message"] . "</li>";
    }

}
