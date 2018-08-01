<?php

class HtmlDoc {

    private $stylesheets = array();
    private $title;
    private $menuItems   = array();

    public function show() {
        $this->renderHeader();
        $this->renderNavigation();
        $this->renderBody();
        $this->renderFooter();
    }

    protected function renderHeader() {
        echo "<!DOCTYPE html>
				<html>
				<head>";

        echo "<title>{$this->title}</title>";
        echo "<script src='https://code.jquery.com/jquery-3.3.1.js' ></script>";


        if (!empty($this->stylesheets)) {
            foreach ($this->stylesheets as $sheet) {
                echo "<link rel=\"stylesheet\" href=\"";
                echo ROOT . "css/" . $sheet . ".css\">";
            }
        }


        echo "</head> ";
    }

    protected function renderNavigation() {
        
    }

    protected function renderBody() {
        
    }

    protected function renderFooter() {

        echo "</body>
			</html>";
    }

    protected function setTitle($title) {
        $this->title = $title;
    }

    protected function addStylesheet($filename) {
        array_push($this->stylesheets, $filename);
    }

    protected function addMenuItem($name, $location) {
        $item = array($name, $location);
        array_push($this->menuItems, $item);
    }

}
