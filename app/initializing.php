<?php

use App\Models\DbOperations;
use App\Controller\Controller;
use App\Models\Validate;

require __DIR__ . '/../vendor/autoload.php';

$db_oper = new DbOperations;
$controller = new Controller;
$validate = new Validate;

$errs = "";

isset($_POST['submit']) && empty($errs = $controller->validate()) ?
$controller->proceedInsert() : null;

isset($_POST['delIdCheckBox']) ? $controller->deleteProducts() : null;