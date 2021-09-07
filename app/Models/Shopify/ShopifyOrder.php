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
        if (isset($order->customer)) {
            $this->order->customer_email = $order->customer->email;
        }else{
            $shopData = $this->shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];
            $this->order->customer_email = $shopData->email;
        }

        $this->order->items[] = (new ShopifyProduct($this->shop, $order->line_items))->items;
    }
}
