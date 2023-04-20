<?php

namespace Models\Products;

use Models\Product;

class DVD extends Product 
{
    public $size;
    public function __construct($args=[]) 
    {
        $this->sku = $args['sku'] ?? '';
        $this->name = $args['name'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->size = $args['size'] ?? '';
        $this->type = 'DVD';
    }
}