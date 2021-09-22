<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\OrdersProviderContract;

class OrdersController extends Controller
{
    public function index(OrdersProviderContract $adapter)
    {
        $data['orders'] = $adapter->getOrders();
        return response()->json($data, 200);
    }

    public function getOrderByAdapter(Request $request, OrdersProviderContract $adapter)
    {
        $order = $adapter->getOrderById($request->id);
        return response()->json($order, 200);
    }

    public function getByDashboard($orderId, $shopId)
    {
        // TODO
    }
}
