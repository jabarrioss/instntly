<?php

namespace App\Adapters;

use App\Contracts\OrderContract;
use App\Contracts\OrdersProviderContract;
use App\Models\Shopify\ShopifyOrder;
use App\Models\User;

class ShopifyAdapter implements OrdersProviderContract
{
    public $shop;
    
    public $api_version;
    
    public $base_uri;
    
    public function __construct($adapter)
    {
        $this->api_version = config('shopify-app.api_version');
        $this->base_uri = "/admin/api/" . $this->api_version . "/";

    }

    public function setAuth($user, $pass)
    {
        $user = User::where("name", $user)->first();
        auth()->setUser($user);
        $this->shop = auth()->user();
    }

    public function getOrderById($orderId) : OrderContract
    {
        $order = $this->shop
        ->api()
        ->rest('GET', "/admin/api/". $this->api_version ."/orders/$orderId.json")['body']['order'];
        return new ShopifyOrder($this->shop, $order);
    }

    public function getOrders()
    {
        $orders = $this->shop
        ->api()
        ->rest('GET', "/admin/api/". $this->api_version ."/orders.json")['body']['orders'];
        $ordersCollection = collect();
        foreach ($orders as $order) {
            $ordersCollection->push(new ShopifyOrder($this->shop, $order));
        }
        return $ordersCollection;
    }

    public function issueRefundForOrder($orderId)
    {
        $this->getOrderById($orderId);
    }
}
