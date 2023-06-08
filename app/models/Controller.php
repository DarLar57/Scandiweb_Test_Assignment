<?php

namespace Models;

use Models\Products\Book;
use Models\Products\DVD;
use Models\Products\Furniture;

include ('./app/models/Products/Book.php');
include ('./app/models/Products/DVD.php');
include ('./app/models/Products/Furniture.php');

class Controller
{
    // All Prod. Types getter using method from extended Prod. Class
    function getProductTypes(): array
    {
        $children = array();
        foreach(get_declared_classes() as $class) {
            if (is_subclass_of( $class, 'Models\Product' )) {
                $children[] = (new $class)->getType();
            } 
        }
        return $children;
    }

    function selected($type): void
    {
        if (isset($_POST['typeSwitcher']) && $_POST['typeSwitcher'] == $type) {
            echo 'selected';
        }
    }
    //Requesting arr of items from db via DbOperations class
    public function getAllProducts(): array
    {
        return (new DbOperations)->getAll();
    }

    // Requesting items' deletion via DbOperations class
    public function deleteProducts(): void
    {
        (new DbOperations)->delete();
    }
    
    // Requesting to insert items via DbOperations class
    public function input($add_obj): array
    {
        $attributes = $this->sanitizeAttr($add_obj);
        (new DbOperations)->insert($attributes);
        return $attributes;
    }

    // Escaping Values improper for SQL
    private function sanitizeAttr($add_obj): array
    {
        $sanitized = [];
        foreach ($this->getAttributes($add_obj) as $key => $value) {
            if ($key == 'type') { 
                continue;
            }
            $sanitized[$key] = DB::$db->real_escape_string($value);
        }
        return $sanitized;
    }

    // Geting Cols and Values for the Class
    private function getAttributes($add_obj): array
    {
        $attributes = [];
        foreach ($add_obj as $key => $value) {
            if ($key == 'id') {
                continue;
            }
            $attributes[$key] = $value;
        }
        return $attributes;
    }

    function modifyDims($str): string
    {
        $replaced_str_dim = str_replace(['[', ']'], ' ', $str);
        $new_arr = explode(', ', $replaced_str_dim);
        $new_str = implode('x', $new_arr);
        return $new_str;
    }

    function validate(): ?string
    {
        return (new Validate)->validateInputs();
    }
    
    function proceedInsert(): void
    {
        $arg = [];
        $arg['sku'] = $_POST['sku'] ?? NULL;
        $arg['name'] = $_POST['name'] ?? NULL;
        $arg['weight'] = $_POST['weight'] ?? NULL;
        $arg['price'] = $_POST['price'] ?? NULL;
        $arg['size'] = $_POST['size'] ?? NULL;
        $arg['height'] = $_POST['height'] ?? NULL;
        $arg['length'] = $_POST['length'] ?? NULL;
        $arg['width'] = $_POST['width'] ?? NULL;
                
        if ($_POST['size'] != NULL) {
            $add_obj = new DVD($arg);
        }
    
        elseif ($_POST['weight'] != NULL) {
            $add_obj = new Book($arg);
        }
    
        elseif ($_POST['width'] != NULL) {
            $add_obj = new Furniture($arg);
        }
        
        //inserting into database through Controller class using DB class
        $this->input($add_obj);
        header("Location: index.php");
    }
}