<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shopify\{
    ShopifyOrder,
    ShopifyProduct,
};
use App\Models\User;
use App\Contracts\OrdersProviderContract;

class TestsController extends Controller
{
    public $api_version;
    public $shop;
    public $base_uri;

    public function __construct()
    {
        $this->api_version = config('shopify-app.api_version');
        $this->base_uri = "/admin/api/" . $this->api_version . "/";

    }
    public function test(OrdersProviderContract $adapter)
    {
        $data['orders'] = $adapter->getOrders();
        return response()->json($data, 200);
        // $user = User::where("name", "test-store692021.myshopify.com")->first();
        // auth()->setUser($user);
        // $this->shop = auth()->user();

        // $order = $this->shop
        //     ->api()
        //     ->rest('GET', $this->base_uri ."orders/4141740589224.json")['body']['order'];

        // // dump($order);
        // $shopifyOrder = new ShopifyOrder($this->shop, $order);
        // // dump($shopifyOrder);
        // return response()->json($shopifyOrder, 200);
        // $productResponse = $this->shop
        // ->api()
        // ->rest('GET', $this->base_uri . "products/7042807988392.json")['body']['product'];
        // ->rest('GET', $this->base_uri ."products/7042807988392/images.json")['body']['images'];
        // dd($productResponse);
    }
}
