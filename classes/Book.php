<?php

namespace Classes;

class Book extends Product
{
    public $weight;
    public $type = 'Book';
    static public $cols = ['id', 'sku', 'name', 'price', 'weight'];
    public function __construct($args=[]) 
    {
        $this->sku = $args['sku'];
        $this->name = $args['name'];
        $this->price = $args['price'];
        $this->weight = $args['weight'];
    }
}