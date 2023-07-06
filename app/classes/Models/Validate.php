<?php

namespace App\Models;

require './vendor/autoload.php';

use App\Controller\Controller;

class Validate
{
    public $prodProp = [];
    public function __construct() 
    {
        $this->prodProp = ['sku', 'name', 'price'];
    }

    public function validateInputs(): ?string
    {
        $errs = [];   
        $inputs = $this->getInputs();    
        foreach ($inputs as $input) {
            (empty($_POST[$input]) || trim($_POST[$input]) == '') ?
                $errs[] = "<b>" . ucfirst($input) . "</b>cannot be empty!" : null;
        }
        
        self::validateSpecChar('sku') ? $errs[] = self::validateSpecChar('sku') : null;
        self::validateSpecChar('name') ? $errs[] = self::validateSpecChar('name') : null;
        self::validateSKU() ? $errs[] = self::validateSKU() : null;        
        
        $attrs=['weight', 'price', 'size', 'h', 'l', 'w'];
        for($i = 0; $i < count($attrs); $i++) {
            $a = $attrs[$i];
            if (!empty($_POST[$a]) && !is_numeric($_POST[$a])) {
                $err = "<b>Please</b>provide numeric value for the <b>";
                $err .= "$attrs[$i]!</b>";
                $errs[] = $err;
            }   
        }
        if (!empty($errs)) {
            return $this->displayErrs($errs);
        } else return null;
    }
    static private function validateSpecChar($prop): mixed
    {
        $pattern = "/^[a-zA-Z0-9]*$/";
        if (preg_match($pattern, $_POST[$prop]) === 0) {
            $err = "<b>Please</b>include only letters, numbers or the ";
            $err .= "combination of both in the <b>$prop</b>!";
            return $err;
        }   else return null;
    }
    static private function validateSKU(): ?string
    {
        if (DbOperations::checkSKU() != (NULL or '')) {
            return DbOperations::checkSKU();
        } else return null;
    }
    // get Product's properties
    private function getInputs(): array
    {
        $classes = (new Controller)->getProductTypes();
        $i = 0;
        switch ($_POST['typeSwitcher']) {
            case $classes[$i++]:
                array_push($this->prodProp,'weight');
                break;
            case $classes[$i++]:
                array_push($this->prodProp,'size');
                break;
            case $classes[$i++]:
                array_push($this->prodProp,'width', 'length', 'height');
                break;
        }
        return $this->prodProp;
    }

    private function displayErrs($errs=[]): ?string
    {
        $display = '';
        if (!empty($errs)) {
            $display .= "<div class=\"errs\"><ul>";
            foreach($errs as $err) {
                $display .= "<li>" . $err . "</li>";
            }
            $display .= "</ul></div>";
        }

        return $display;
    }
}