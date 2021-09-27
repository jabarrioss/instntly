<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\OrdersProviderContract;

class OrdersController extends Controller
{
    public function index(OrdersProviderContract $adapter, Request $request)
    {
        $data['orders'] = $adapter->getOrders()->toArray();
        $data['adapter'] = $request->adapter;
        $data['shop'] = $request->shop;
        if ($request->accepts(['text/html'])) {
            return view('orders-list', $data);
        }else{
            return response()->json($data, 200);
        }
    }

    public function getOrderByAdapter(Request $request, OrdersProviderContract $adapter)
    {
        $data['order'] = $adapter->getOrderById($request->id);
        if($request->has('shop')){
            $data['shopDomain'] = $request->shop;
        }
        if ($request->accepts(['text/html'])) {
            return view('order-refund', $data);
        }else{
            return response()->json($data, 200);
        }
    }

    public function getByDashboard(Request $request, $orderId, OrdersProviderContract $adapter)
    {
        $data['order'] = $adapter->getOrderById($orderId);
        if($request->has('shop')){
            $data['shopDomain'] = $request->shop;
        }

        return view("livewire.order");
    }
}
