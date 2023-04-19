<?php

namespace Classes;

class Furniture extends Product
{
    public $dimensions;
    protected $w;
    protected $l;
    protected $h;
    public $type = 'Furniture';
    static public $cols = ['id', 'sku', 'name', 'price', 'dimensions'];

    public function __construct($args=[]) 
    {
        $this->sku = $args['sku'];
        $this->name = $args['name'];
        $this->price = $args['price'];
        $this->dimensions = "[" . $args['h'] . ", " . $args['w'] . ", " . 
        $args['l'] . "]";
    }
}