<?php
class Validate {
    private $fields;

    public function __construct() {
        $this->fields = new Fields();
    }

    public function getFields() {
        return $this->fields;
    }

    // Validate a generic text field
    public function text($name, $value,
            $required = true, $min = 1, $max = 255) {

        // Get Field object
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Check field and set or clear error message
        if ($required && empty($value)) {
            $field->setErrorMessage('Required.');
        } else if (strlen($value) < $min) {
            $field->setErrorMessage('Too short.');
        } else if (strlen($value) > $max) {
            $field->setErrorMessage('Too long.');
        } else {
            $field->clearErrorMessage();
        }
    }

    // Validate a field with a generic pattern
    public function pattern($name, $value, $pattern, $message,
            $required = true) {

        // Get Field object
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Check field and set or clear error message
        $match = preg_match($pattern, $value);
        if ($match === false) {
            $field->setErrorMessage('Error testing field.');
        } else if ( $match != 1 ) {
            $field->setErrorMessage($message);
        } else {
            $field->clearErrorMessage();
        }
    }

    public function email($name, $value, $required = true) {
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) { return; }

        // Validate using filter_var() with FILTER_VALIDATE_EMAIL
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $field->setErrorMessage('Invalid email address.');
            return;
        }

        $field->clearErrorMessage();
    }

    public function password($name, $password, $required = true) {
        $field = $this->fields->getField($name);

        if (!$required && empty($password)) {
            $field->clearErrorMessage();
            return;
        }

        $this->text($name, $password, $required, 8);
        if ($field->hasError()) { return; }

        $pw = '/^(?=.*[A-Z])(?=.*\d).{8,}$/';

        $pwMatch = preg_match($pw, $password);

        if ($pwMatch === false) {
            $field->setErrorMessage('Error testing password.');
            return;
        } else if ($pwMatch != 1) {
            $field->setErrorMessage(
                    'Must have one each of upper, digit');
            return;
        }
    }
    
    public function verify($name, $password, $verify, $required = true) {
        $field = $this->fields->getField($name);
        $this->text($name, $verify, $required, 6);
        if ($field->hasError()) { return; }

        if (strcmp($password, $verify) != 0) {
            $field->setErrorMessage('Passwords do not match.');
            return;
        }
    }

    public function dueDate($name, $value) {
        $field = $this->fields->getField($name);
        $datePattern = '/^[1-9][[:digit:]]{3}?\-(0[1-9]|1[012])\-(0[1-9]|1[0-9]|2[0-9]|3[01])$/';
        $match = preg_match($datePattern, $value);
        if ( $match === false ) {
            $field->setErrorMessage('Error testing field.');
            echo('This is problem1');
            return;
        }
        if ( $match != 1 ) {
            $field->setErrorMessage('Invalid date format.');
            echo('This is problem2');
            return;
        }
        $field->clearErrorMessage();
    }

}
?>