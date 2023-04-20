<?php

namespace Models;

abstract class Product
{
    public static $cols =[];
    public $id;
    public $sku;
    public $name;
    public $price;
    public $type;

    function getType()
    {
        return $this->type;
    }
}