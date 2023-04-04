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
    public function select_all()
    {
        $sql = "SELECT * FROM products ORDER BY id";
        $result = self::$db->query($sql);
        // Results into objects in arr
        $obj_arr = [];
        while ($row = $result->fetch_assoc()) {
            
            $obj_arr[] = $row;
        }
        $result->free_result();
        return $obj_arr;
        
    }
        // Creating object(s) from items in db
    // Deleting items in db
    public function delete()
    {
        foreach($_POST['delIdCheckBox'] as $del){ 
            $spec_char_del[] = htmlspecialchars($del);
        }
        $sql = "DELETE FROM products WHERE id IN(" . implode(',', $spec_char_del) . ")";
        $result = self::$db->query($sql);
        if ($result) {
            header("refresh: 0");
        }
    }
    // Inserting items in db
    public function input($add_obj)
    {
        $attributes = $this->sanitize_attr($add_obj);
        $sql = "INSERT INTO products (" . implode(', ', array_keys($attributes)) . ") VALUES ('";
        $sql .= implode("', '", array_values($attributes)) . "')";
        $result = self::$db->query($sql);
        if ($result) {
            $this->id = self::$db->insert_id;
        }
        return $result;
    }
    // Escaping Values improper for SQL
    private function sanitize_attr($add_obj)
    {
        $sanitized = [];
        foreach ($this->attributes($add_obj) as $key => $value) {
            $sanitized[$key] = self::$db->real_escape_string($value);
        }
        return $sanitized;
    }
    // Geting Cols and Values for the Class
    private function attributes($add_obj)
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
    function modify_db_dimensions($str)
    {
        $replaced_str_dim = str_replace(['[', ']'], ' ', $str);
        $new_arr = explode(', ', $replaced_str_dim);
        $new_str = implode('x', $new_arr);
        return $new_str;
    }
    function get_type($type)
    {
        if (isset($_POST['typeSwitcher']) && $_POST['typeSwitcher'] == $type) {
            echo 'selected';
        }
    }
}