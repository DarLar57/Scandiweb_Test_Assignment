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
    public function orderAllProducts()
    {
        return (new DB_Operations)->get_all();
    }
    public function orderAllProductsHTML()
    {
        return (new DB_Operations)->get_all();
    }
    // Deleting items in db
    public function orderDeleteProducts()
    {
        (new DB_Operations)->delete();
    }
    // Inserting items in db
    public function orderInput($add_obj)
    {
        $attributes = $this->sanitize_attr($add_obj);
        (new DB_Operations)->insert($attributes);
        return $attributes;
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
    function orderValidate()
    {
        return (new Validate)->validate_inputs();
    }
}