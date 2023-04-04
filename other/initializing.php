<?php

use classes\DB;
use classes\Book;
use classes\DVD;
use classes\Furniture;
use classes\Validate;

include_once('./classes/Product.php');
include_once('./classes/DB.php');
include_once('./classes/Book.php');
include_once('./classes/DVD.php');
include_once('./classes/Validate.php');
include_once('./classes/Furniture.php');

$db_obj = new DB;
$validate = new Validate;

$errs = $validate->validate_inputs();
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
    if ($_POST['weight'] != NULL) {
        $add_obj = new Book($arg);
    }
    elseif ($_POST['w'] != NULL && $_POST['l'] != NULL && $_POST['h'] != NULL) {
        $add_obj = new Furniture($arg);
    }
    header("Location: index.php");

    //inserting into database through DB class
    $db_obj->input($add_obj);
}