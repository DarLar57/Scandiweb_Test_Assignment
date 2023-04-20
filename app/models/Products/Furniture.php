<?php

namespace Models\Products;

use Models\Product;

class Furniture extends Product
{
    public $dimensions;
    protected $w;
    protected $l;
    protected $h;

    public function __construct($args=[]) 
    {
        $this->sku = $args['sku'] ?? '';
        $this->name = $args['name'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->w = $args['w'] ?? '';
        $this->l = $args['l'] ?? '';
        $this->h = $args['h'] ?? '';
        $this->dimensions = "[" . $this->h . ", " . $this->w . ", " . 
        $this->l . "]" ?? '';
        $this->type = 'Furniture';
    }
}