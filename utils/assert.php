<?php

class Assert {

    public static function isUserLoggedIn() {
        if (!isset($_SESSION["user"])) {
            throw new Exception("User trying to cast vote without logging in");
        }
    }

    public static function isNumeric(...$vars) {
        foreach ($vars as $var) {
            if (!is_numeric($var)) {
                throw new InvalidArgumentException('Argument is not a number');
            }
        }
    }

    public static function isInstanceOf($toCheck, $objectName) {
        if (!is_a($toCheck, $objectName)) {
            throw new InvalidArgumentException($toCheck . " is not an instance of " . $objectName);
        }
    }

}
