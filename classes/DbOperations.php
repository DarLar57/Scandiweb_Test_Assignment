<?php

namespace classes;

use classes\DB;

class DbOperations extends DB
{
    public static $db;
    public $id;

    public static function get_all(): array
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

    public function delete()
    {
        foreach($_POST['delIdCheckBox'] as $del){ 
            $spec_char_del[] = htmlspecialchars($del);
        }
        $sql = "DELETE FROM products WHERE id IN";
        $sql .= "(" . implode(',', $spec_char_del) . ")";
        $result = DB::$db->query($sql);
        if ($result) {
            header("refresh: 0");
        }
    }

    public function checkSKU(): ?string 
    {
        $sql = "SELECT * FROM products WHERE sku='" . $_POST['sku'] . "'";
            $result = DB::$db->query($sql);
            if (mysqli_num_rows($result) > 0) {
                $reply = "<b>Please</b>provide unique stock keeping unit<b>";
                $reply .= "(SKU)</b>as the inserted SKU is already in DB! ";
                return $reply;
            } else return null;
    }

    public function insert($attr)
    {
        $sql = "INSERT INTO products (" . implode(', ', array_keys($attr)) . ") VALUES ('";
        $sql .= implode("', '", array_values($attr)) . "')";
        DB::$db->query($sql);
    }
}