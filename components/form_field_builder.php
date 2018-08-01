<?php

class FormFieldBuilder {

    private $label;
    private $type;
    private $name;
    private $value;
    private $errorClass;
    private $errorValue;

    //TO-DO add support for multiple css classes/ids
    function __construct($label, $type, $name, $value, $errorClass, $errorValue) {
        $this->label      = $label;
        $this->type       = $type;
        $this->name       = $name;
        $this->value      = $value;
        $this->errorClass = $errorClass;
        $this->errorValue = $errorValue;
    }

    function build() {
        $field = '';

        $field .= (isset($this->label)) ? "<label>{$this->label}</label>" : '';
        $field .= '<input ';
        $field .= (isset($this->type)) ? "type=\"{$this->type}\" " : '';
        $field .= (isset($this->name)) ? "name=\"{$this->name}\" " : '';
        $field .= (isset($this->value)) ? "value=\"{$this->value}\" " : '';
        $field .= '/><br />';

        if (isset($this->errorClass) || isset($this->errorValue)) {
            $field .= '<span ';
            $field .= (isset($this->errorClass)) ? " class=\"{$this->errorClass}\" " : '';
            $field .= ">";
            $field .= (isset($this->errorValue)) ? "{$this->errorValue} " : '';
            $field .= '</span><br>';
        }
        return $field;
    }

}
