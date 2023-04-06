<?php

namespace classes;

use mysqli;
use Exception;

class DB
{
    
    public static $db;
    const DB_HOST = "localhost";
    const DB_USR = "root";
    const DB_PSW = "";
    const DB_NM = "epiz_33155713_Scandiweb_Test_Assignment_DL";
    public $type;
    public $id;
    
    public function __construct() 
    {
        try {
            self::$db = new mysqli(DB::DB_HOST, DB::DB_USR, DB::DB_PSW, DB::DB_NM);
        } catch (Exception $e) {
            echo "Connection failed: " . $e->getMessage();
            }
	}
}