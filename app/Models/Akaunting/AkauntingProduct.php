<?php

namespace App\Models\Akaunting;

class AkauntingProduct
{
    public $items = array();

    public function __construct($shop, $line_items)
    {
        $this->mapItemData($line_items);
    }

    public function mapItemData($line_items)
    {
        $this->items = collect();
        foreach($line_items as $line_item){
            $totalTax = 0;
            $product = new \stdClass();
            $product->image = "https://lorempixel.com/90/90";
            $totalTax += $line_items['tax'];
            $product->title = $line_item['name'];
            $product->quantity = $line_item['quantity'] ?? 1;
            $product->price = $line_item['price'];
            $product->total_tax = $totalTax;
            $this->items->push($product);
        }
    }
}
