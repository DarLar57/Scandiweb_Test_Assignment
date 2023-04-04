<?php

namespace classes;

class DVD extends Product 
{
    public $size;
    static public $cols = ['id', 'sku', 'name', 'price', 'size'];
    public function __construct($args=[]) 
    {
        $this->sku = $args['sku'];
        $this->name = $args['name'];
        $this->price = $args['price'];
        $this->size = $args['size'];
    }
}