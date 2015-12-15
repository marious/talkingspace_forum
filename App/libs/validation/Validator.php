<?php

namespace App\libs\validation;

use Illuminate\Database\Capsule\Manager as DB;

class Validator
{
    private $errors = [];

    public function isValid(Array $validation_data, $methodType = "post")
    {
        // ['name' => 'required|min:3']
        foreach ($validation_data as $item => $ruleset) {
            if (isset($_REQUEST[$item])) {
                $ruleset = explode('|', $ruleset);

                foreach ($ruleset as $rule) {
                    $pos = strpos($rule, ':');
                    if ($pos != false) {
                        $parameter = substr($rule, $pos+1);
                        $rule = substr($rule, 0, $pos);
                    } else {
                        $parameter = '';
                    }

                    $methodName = "validate" . ucfirst($rule);
                    $value = ($methodType == 'post') ? $_POST[$item] : $_REQUEST[$item];
                    if (method_exists($this, $methodName)) {
                        $this->$methodName($item, $value, $parameter);
                    }
                }
            } else {
                $this->errors[] = "No Value Found";
            }
        }

        return $this->errors;
    }

    private function formatName($name)
    {
        return ucwords(str_replace('_', ' ', $name));
    }


    private function validateRequired($item, $value, $parameter)
    {
        if ($value == '' || $value == null) {
            $this->errors[] = "The " . $this->formatName($item) . " field is Required.";
        }
    }

    private function validateMin($item, $value, $parameter)
    {
        if ($value <= $parameter) {
            $this->errors[] = $this->formatName($item) . " must be at least {$parameter} Characters long!.";
        }
    }

    private function validateEmail($item, $value, $parameter)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL) == false) {
            $this->errors[] = $this->formatName($item)  . " must be a valid email address.";
        }
    }

    private function validateAlnum($item, $value, $parameter)
    {
        if (ctype_alnum($value) == false) {
            $this->errors[] = $this->formatName($item) . ' must be alphanumeric only.';
        }
    }

    private function validateEqualTo($item, $value, $parameter)
    {
        if ($value !== $_POST[$parameter]) {
            $this->errors[] = $this->formatName($item) . ' field does not match the ' .$this->formatName($parameter) . ' field.';
        }
    }

    private function validateUnique($item, $value, $parameter)
    {
        $results = DB::table($parameter)->where($item, '=', $value)->get();
        if (sizeof($results) > 0) {
            $this->errors[] = $item . ' already exists on this system.';
        }
    }


    private function validateCaptcha($item, $value, $parameter)
    {
        /**
         * Binary safe case-insensitive string comparison.
         */
        if (strcasecmp($value, $_SESSION['captcha']) !== 0) {
            $this->errors[] = 'The verification code is incorrect';
        }
    }

}