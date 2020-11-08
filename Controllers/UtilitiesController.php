<?php
    namespace Controllers;

    class UtilitiesController
    {
        public static function validateFieldNumber($fieldNumber)
        {
            if (validateField($fieldNumber) && is_numeric($fieldNumber) && $fieldNumber > 0) {
                return true;
            } else {
                return false;
            }
        }

        public static function validateField($field)
        {
            if (isset($field) && !empty($field)) {
                return true;
            } else {
                return false;
            }
        } 
    }
