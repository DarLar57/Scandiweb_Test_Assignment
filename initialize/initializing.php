<?php

use Classes\DbOperations;
use Classes\Controller;
use Classes\Book;
use Classes\DVD;
use Classes\Furniture;
use Classes\Validate;

include_once('included.php');

$db_oper = new DbOperations;
$controller = new Controller;
$validate = new Validate;

$errs = $controller->orderValidate();

if(isset($_POST['submit']) && empty($errs)){
    $arg = [];
    $arg['sku'] = $_POST['sku'] ?? NULL;
    $arg['name'] = $_POST['name'] ?? NULL;
    $arg['weight'] = $_POST['weight'] ?? NULL;
    $arg['price'] = $_POST['price'] ?? NULL;
    $arg['size'] = $_POST['size'] ?? NULL;
    $arg['h'] = $_POST['h'] ?? NULL;
    $arg['l'] = $_POST['l'] ?? NULL;
    $arg['w'] = $_POST['w'] ?? NULL;
            
    if ($_POST['size'] != NULL) {
        $add_obj = new DVD($arg);
    }

    elseif ($_POST['weight'] != NULL) {
        $add_obj = new Book($arg);
    }

    elseif (
        $_POST['w'] != NULL 
        && $_POST['l'] != NULL 
        && $_POST['h'] != NULL
    ) {
        $add_obj = new Furniture($arg);
    }
    
    //inserting into database through Controller class using DB class
    $controller->orderInput($add_obj);
    header("Location: index.php");
}