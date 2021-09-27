<?php

namespace App\Models\Shopify;

use App\Contracts\OrderContract;

class ShopifyOrder extends BaseModel implements OrderContract
{
    public $order;

    public function __construct($shop, $order)
    {
        parent::__construct($shop, $order);
        $this->mapOrderData($order);
    }

    public function mapOrderData($order)
    {
        $this->order = new \stdClass();
        $this->order->id = $order->id;
        $this->order->number = $order->name;
        $this->order->subTotal = $order->current_subtotal_price;
        if (isset($order->customer)) {
            $this->order->customer_email = $order->customer->email;
        }else{
            $this->order->customer_email = "";
        }

        if (isset($order->line_items)) {
            $this->order->items = (new ShopifyProduct($this->shop, $order->line_items))->items;
        }
    }
}
