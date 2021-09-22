<?php

namespace App\Adapters;

use App\Contracts\OrderContract;
use App\Contracts\OrdersProviderContract;
use App\Models\Shopify\ShopifyOrder;
use Exception;

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
        $integrations = $user->integrations()
        ->where("adapter", "shopify")
        /**
         * I'm only fetching the first shop by request of kleverpay, this could be
         * replaced for ->get() to get an array of stores
         * */
        ->first();
        $this->shop = $integrations->integrations()->first();
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
        $request = $this->shop
        ->api()
        ->rest('GET', "/admin/api/". $this->api_version ."/orders.json");
        if($request['status'] == 200 && !$request['errors']){
            $orders = $request['body']['orders'];
            $ordersCollection = collect();
            foreach ($orders as $order) {
                $ordersCollection->push(new ShopifyOrder($this->shop, $order));
            }
            return $ordersCollection;
        }else{
            throw new Exception("There's some error in the request: ". $request['body'], $request['status']);
        }
    }

    public function issueRefundForOrder($orderId)
    {
        $this->getOrderById($orderId);
    }
}
