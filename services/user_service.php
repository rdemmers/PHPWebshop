<?php

require_once(MODEL . "user_dao.php");
require_once (MODEL . "user.php");

class UserService {

    private $userDao;

    function __construct(UserDao $userDao) {
        $this->userDao = $userDao;
    }

    function validateAndLogin() {
        $sEmail    = filter_input(INPUT_POST, 'email');
        $sPassword = filter_input(INPUT_POST, 'password');

        // Check if email is filled, validate if the information is correct and start the session
        if ($sEmail != "" && $sPassword != "") {
            $user = $this->userDao->validateCredentials($sEmail, $sPassword);
            if (!$user) {
                echo "Gebruikersnaam/password niet correct";
                return false;
            }
            $_SESSION['user'] = $user;
            return true;
        } else {
            echo "Please fill both username and password";
            return false;
        }
    }

    function handleRegistration($user) {
        Assert::isInstanceOf($user, "User");
        if ($this->userDao->checkEmailAvailable($user->getEmail())) {

            $this->userDao->add($user);
            $user = $this->userDao->validateCredentials($user->getEmail(), $user->getPassword());
            if (!$user) {
                return array("sName" => "", "sEmail" => "", "sPassword" => "", "sError" => "Er ging iets mis bij de registratie, probeer het later opnieuw!");
            } else {
                $_SESSION['user'] = $user;
                return true;
            }
        } else {
            return array("sName" => $user->getName(), "sEmail" => $user->getEmail(), "sPassword" => $user->getPassword(), "sError" => "Email is al in gebruik!");
        }
    }

}
