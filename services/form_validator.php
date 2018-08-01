<?php

class FormValidator {

    function validateAndHandleContact() {
        $boolHasErrors = false;
        $sName         = $sEmail        = $sMessage      = "";
        $sNameErr      = $sEmailErr     = $sMessageErr   = "";
        //check if any fields are empty -> return error
        // set $validated if there are no errors
        if (filter_input(INPUT_POST, 'name') === "") {
            $sNameErr      = "Dit veld is verplicht";
            $boolHasErrors = true;
        } else {
            $sName = $this->sanitize(filter_input(INPUT_POST, 'name'));
        }
        if (filter_input(INPUT_POST, 'email') === "") {
            $sEmailErr     = "Dit veld is verplicht";
            $boolHasErrors = true;
        } else {
            $sEmail = $this->sanitize(filter_input(INPUT_POST, 'email'));
        }
        if (filter_input(INPUT_POST, 'message') === "") {
            $sMessageErr   = "Dit veld is verplicht";
            $boolHasErrors = true;
        } else {
            $sMessage = $this->sanitize(filter_input(INPUT_POST, 'message'));
        }

        if ($boolHasErrors) {
            $previouslyFilled = array("sName" => filter_input(INPUT_POST, 'name'), "sEmail" => filter_input(INPUT_POST, 'email'), "sMessage" => filter_input(INPUT_POST, 'message'));
            $error            = array("sName" => $sNameErr, "sEmail" => $sEmailErr, "sMessage" => $sMessageErr);

            $values = array("previouslyFilled" => $previouslyFilled, "error" => $error);
            return $values;
        }

        return null;
    }

    public function validateRegistrationForm() {
        $name           = filter_input(INPUT_POST, 'name');
        $email          = filter_input(INPUT_POST, 'email');
        $password       = filter_input(INPUT_POST, 'password');
        $passwordRepeat = filter_input(INPUT_POST, 'password_repeat');

        if ($password === $passwordRepeat && !empty($name) && !empty($email) && !empty($password)) {
            $user = new User(null, $this->sanitize($email), $this->sanitize($name));
            $user->setPassword($password);
            return $user;
        } else {
            return array("sName" => $name, "sEmail" => $email, "sPassword" => "$password", "sError" => "Wachtwoord komt niet overeen!");
        }
    }

    private function sanitize($sData) {
        $sData = trim($sData);
        $sData = stripslashes($sData);
        $sData = htmlspecialchars($sData);
        return $sData;
    }

}
