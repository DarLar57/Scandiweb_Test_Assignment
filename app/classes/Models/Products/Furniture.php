<?php

namespace App\Models\Products;

use App\Models\Product;

class Furniture extends Product
{
    public $dimensions;
    protected $width;
    protected $length;
    protected $height;

    public function __construct($args=[]) 
    {
        $this->sku = $args['sku'] ?? '';
        $this->name = $args['name'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->width = $args['width'] ?? '';
        $this->length = $args['length'] ?? '';
        $this->height = $args['height'] ?? '';
        $this->dimensions = "[" . $this->height . ", " . $this->width . ", " . 
        $this->length . "]" ?? '';
        $this->type = 'Furniture';
    }
}