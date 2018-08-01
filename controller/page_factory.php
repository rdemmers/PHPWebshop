<?php

class PageFactory {

    function prepareRequestedPage($returnBody): WebshopHtmlDoc {
        // Page router
        switch (MainController::$pageName) {
            case "HOME":
                require_once(VIEW . "home_page.php");
                return new HomePage($returnBody);
            case "ABOUT":
                require_once(VIEW . "about_page.php");
                return new AboutPage($returnBody);
            case "CONTACT":
                require_once(VIEW . "contact_page.php");
                return new ContactPage($returnBody);
            case "LOGIN":
                if (isset($_SESSION["user"])) {
                    require_once(VIEW . "home_page.php");
                    return new HomePage($returnBody);
                } else {
                    require_once(VIEW . "login_page.php");
                    return new LoginPage($returnBody);
                }
            case "LOGOUT":
                unset($_SESSION["user"]);
                require_once(VIEW . "home_page.php");
                return new HomePage($returnBody);
            case "REGISTER":
                if (isset($_SESSION["user"])) {
                    require_once(VIEW . "home_page.php");
                    return new HomePage($returnBody);
                }
                require_once(VIEW . "register_page.php");
                return new RegisterPage($returnBody);
            case "WEBSHOP":
                if (isset($_GET['product'])) {
                    if (!$returnBody) {

                        require_once(VIEW . "error_page.php");
                        return new ErrorPage("Product with given ID could not be found");
                    }
                    require_once(VIEW . "product_page.php");
                    return new ProductPage($returnBody);
                } else {
                    require_once(VIEW . "webshop_page.php");
                    return new WebshopPage($returnBody);
                }
                break;
            case "CART":
                require_once(VIEW . "shoppingcart_page.php");
                return new ShoppingcartPage($returnBody);
            case "ERROR":
                require_once(VIEW . "error_page.php");
                return new ErrorPage($returnBody);
            default :
                require_once(VIEW . "home_page.php");
                return new HomePage($returnBody);
        }
    }

}
