<?php

namespace Models\Products;

use Models\Product;

class Book extends Product
{
    public $weight;
    public function __construct($args=[]) 
    {
        $this->sku = $args['sku'] ?? '';
        $this->name = $args['name'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->weight = $args['weight'] ?? '';
        $this->type = 'Book';
    }
}