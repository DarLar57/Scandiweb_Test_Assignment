<?php

namespace classes;

class Controller
{
    //public $type;
    public $id;

    function selected($type)
    {
        if (isset($_POST['typeSwitcher']) && $_POST['typeSwitcher'] == $type) {
            echo 'selected';
        }
    }
    
    //types of all Products exracted from all sub-classes to form automativally options
    function getProductTypes()
    {
        $children = array();
        foreach(get_declared_classes() as $class) {
            if (is_subclass_of( $class, 'classes\Product' )){
                $children[] = (new $class)->getType();
            }
        }
        return $children;
    }
    public function select_all()
    {
        $sql = "SELECT * FROM products ORDER BY id";
        $result = DB::$db->query($sql);
        // Results into objects in arr
        $obj_arr = [];
        while ($row = $result->fetch_array()) {
            
            $obj_arr[] = $row;
        }
        $result->free_result();
        return $obj_arr;
        
    }
    // Deleting items in db
    public function delete()
    {
        foreach($_POST['delIdCheckBox'] as $del){ 
            $spec_char_del[] = htmlspecialchars($del);
        }
        $sql = "DELETE FROM products WHERE id IN(" . implode(',', $spec_char_del) . ")";
        $result = DB::$db->query($sql);
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
        $result = DB::$db->query($sql);
        if ($result) {
            $this->id = DB::$db->insert_id;
        }
        return $result;
    }
    // Escaping Values improper for SQL
    private function sanitize_attr($add_obj)
    {
        $sanitized = [];
        foreach ($this->attributes($add_obj) as $key => $value) {
            if ($key == 'type') { 
                continue;
            }
            $sanitized[$key] = DB::$db->real_escape_string($value);
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
}