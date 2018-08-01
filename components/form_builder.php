<?php

require_once(COMPONENT . 'form_field_builder.php');

class FormBuilder {

    private $class;
    private $action;
    private $method;
    private $fields = [];

    function __construct($class, $action, $method) {
        $this->class  = $class;
        $this->action = $action;
        $this->method = $method;
    }

    public function addField($label, $type, $name, $value) {
        $formField = new FormFieldBuilder($label, $type, $name, $value, NULL, NULL);

        $this->fields[] = $formField->build();
    }

    public function addFieldWithError($label, $type, $name, $value, $errorClass, $errorValue) {
        $formField = new FormFieldBuilder($label, $type, $name, $value, $errorClass, $errorValue);

        $this->fields[] = $formField->build();
    }

    public function addHiddenField($name, $value) {
        $formField = new FormFieldBuilder(NULL, 'hidden', $name, $value, NULL, NULL);

        $this->fields[] = $formField->build();
    }

    public function addSubmit($value) {
        $formField = new FormFieldBuilder(NULL, 'submit', NULL, $value, NULL, NULL);

        $this->fields[] = $formField->build();
    }

    public function display() {

        $form = '<form ';
        $form .= (isset($this->class)) ? "class=\"{$this->class}\" " : '';
        $form .= (isset($this->action)) ? "action=\"{$this->action}\" " : '';
        $form .= (isset($this->method)) ? "method=\"{$this->method}\" " : '';
        $form .= '/>';

        foreach ($this->fields as $field) {
            $form .= $field;
        }

        $form .= '</form>';
        echo $form;
    }

}
