<?php

namespace App\Models\Akaunting;

use App\Contracts\OrderContract;

class AkauntingOrder implements OrderContract
{
    public $client;
    public $order;

    public function __construct($client, $order)
    {
        $this->mapOrderData($order);
    }
    public function mapOrderData($order)
    {
        $this->order = new \stdClass();
        $this->order->id = $order['id'];
        $this->order->number = $order['document_number'];
        $this->order->customer_email = $order['contact_email'];
        $this->order->items[] = (new AkauntingProduct($this->client, $order['items']['data']))->items;

    }

}
