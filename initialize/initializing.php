<?php

use Classes\DbOperations;
use Classes\Controller;
use Classes\Validate;

include_once('./Classes/Product.php');
include_once('./Classes/DB.php');
include_once('./Classes/DbOperations.php');
include_once('./Classes/Controller.php');
include_once('./Classes/Book.php');
include_once('./Classes/DVD.php');
include_once('./Classes/Validate.php');
include_once('./Classes/Furniture.php');

$db_oper = new DbOperations;
$controller = new Controller;
$validate = new Validate;
$errs = "";

if (isset($_POST['submit']) && empty($errs = $controller->validate())) {
    $controller->proceedInsert();
}

isset($_POST['delIdCheckBox']) ? $controller->deleteProducts() : null;