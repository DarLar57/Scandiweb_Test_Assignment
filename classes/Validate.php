<?php

namespace Classes;

class Validate
{
    public static $cols =[];
    public $id;
    public $sku;
    public $name;
    public $price;

    public function validate_inputs()
    {
        $errs = [];   
         
        if (isset($_POST['submit'])) {
            $inputs_prop = $this->get_inputs();    
            foreach ($inputs_prop as $input) {
                if (empty($_POST[$input]) || trim($_POST[$input]) == '') {
                    $errs[] = "<b>" . ucfirst($input) . "</b>cannot be empty!";
                }
            }
            
            // input strings include spec char?
            $pattern = "/^[a-zA-Z0-9]*$/";
            if (preg_match($pattern, $_POST['sku']) === 0) {
                $err = "<b>Please</b>include only letters, numbers or the ";
                $err .= "combination of both in the <b>SKU</b>!";
                $errs[] = $err;
            }    

            if (preg_match($pattern, $_POST['name']) === 0) {
                $err = "<b>Please</b>include only letters, numbers or the ";
                $err .= "combination of both in the <b>Name</b>!";
                $errs[] = $err;
            }    

            // sku in db?
            $db_oper = new DbOperations;
            $db_oper->checkSKU() != (NULL or '')? 
                $errs[] = $db_oper->checkSKU() : ''; 
            
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
                return $this->display_errs($errs);
            } 
        }
    }

    // get Product's prop. arr
    private function get_inputs() 
    {
        $input_prop = ['sku', 'name', 'price'];    
        switch ($_POST['typeSwitcher']) {
            case 'DVD':
                $input_prop[] = 'size';
                break;
            case 'Book':
                $input_prop[] = 'weight';
                break;
            case 'Furniture':
                array_push($input_prop,'w', 'l', 'h');
                break;
        }

        return $input_prop;
    }

    private function display_errs($errs=[])
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