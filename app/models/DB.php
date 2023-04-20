<?php

namespace Models;

use mysqli;
use Exception;

class DB
{
    public static $db;
    public const DB_HO = "localhost";
    public const DB_US = "root";
    public const DB_PS = "";
    public const DB_NA = "epiz_33155713_Scandiweb_Test_Assignment_DL";
    public $type;
    public $id;
    
    public function __construct() 
    {
        try {
            self::$db = new mysqli(DB::DB_HO, DB::DB_US, DB::DB_PS, DB::DB_NA);
        } catch (Exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
	}
}