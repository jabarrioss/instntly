<?php

namespace App\Models\Shopify;
use Illuminate\Support\Str;

class ShopifyProduct extends BaseModel
{
    public $items = array();

    public function __construct($shop, $line_items)
    {
        parent::__construct($shop, $line_items);
        $this->mapItemData($line_items);
    }

    public function mapItemData($line_items)
    {
        $this->items = collect();
        foreach($line_items as $line_item){
            $totalTax = 0;
            $product = new \stdClass();
            if ($line_item->product_exists) {
                $product->id = $line_item->product_id;
                $images = $this->shop
                ->api()
                ->rest('GET', $this->base_uri ."products/".$line_item->product_id."/images.json")['body']['images'];
                if (count($images) > 0) {
                    $product->image = $images[0]->src;
                }else {
                    $product->image = secure_asset("assets/img/shoe.png");
                }
            }else{
                $product->id = (string) Str::uuid();
                $product->image = secure_asset("assets/img/shoe.png");
            }
    
            if ($line_item->taxable) {
                foreach ($line_item->tax_lines as $tax) {
                    $totalTax += $tax->price;
                }
            }
    
            $product->title = $line_item->title;
            $product->quantity = $line_item->quantity;
            $product->price = $line_item->price;
            $product->total_tax = $totalTax;
            $this->items->push($product);
        }
    }
}
