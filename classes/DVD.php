<?php

namespace Classes;

class DVD extends Product 
{
    public $size;
    public $type = 'DVD';
    static public $cols = ['id', 'sku', 'name', 'price', 'size'];
    public function __construct($args=[]) 
    {
        $this->sku = $args['sku'];
        $this->name = $args['name'];
        $this->price = $args['price'];
        $this->size = $args['size'];
    }
}