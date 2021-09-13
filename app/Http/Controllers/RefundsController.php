<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\OrdersProviderContract;

class RefundsController extends Controller
{
    public function getOrderByAdapter(Request $request, OrdersProviderContract $adapter)
    {
        $order = $adapter->getOrderById($request->id);
        return response()->json($order, 200);
    }

    public function sendOrderToKlever(Request $request, $orderId)
    {
        // TODO
    }
}
