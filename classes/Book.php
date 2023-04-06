<?php

namespace classes;


class Book extends Product
{
    public $weight;
    static public $cols = ['id', 'sku', 'name', 'price', 'weight'];
    public function __construct($args=[]) 
    {
        $this->sku = $args['sku'];
        $this->name = $args['name'];
        $this->price = $args['price'];
        $this->weight = $args['weight'];
        $this->type = 'Book';
    }
}