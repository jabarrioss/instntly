<?php

namespace App\Adapters;

use Exception;
use Illuminate\Support\Facades\Http;

use App\Contracts\OrderContract;
use App\Contracts\OrdersProviderContract;
use App\Models\Akaunting\AkauntingOrder;

class AkauntingAdapter implements OrdersProviderContract
{
    protected $client;

    public function setAuth($user, $pass)
    {
        $this->client = Http::withBasicAuth($user, $pass);
    }

    public function getOrderById($orderId) : OrderContract
    {
        $order = $this->shop
        ->get("https://app.akaunting.com/api/documents?company_id=111292&search=type:invoice");

        return new AkauntingOrder($this->client, $order);
    }

    public function getOrders()
    {
        $request = $this->client
        ->get("https://app.akaunting.com/api/documents?company_id=111292&search=type:invoice");

        if($request->status() == 200 && !$request->failed()){
            $orders = $request->collect()['data'];
            $ordersCollection = collect();
            foreach ($orders as $order) {
                $ordersCollection->push(new AkauntingOrder("", $order));
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
