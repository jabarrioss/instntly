<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Contracts\OrdersProviderContract;
use App\Models\Refund;
use App\Models\User;

class RefundsController extends Controller
{
    public function loginToKlever(Request $request)
    {
        $api_url = config('app.instntly.base_uri');
        $response = Http::post($api_url."/auth/login", [
            'email' => "merchant01@kleverlabs.com",
            'password' => "zxcvbnm1"
        ]);

        if ($response->ok()) {
            return response()->json($response->collect(), 200);
        }

        return response()->json(["error" => true, "message" => $request->collect()['message']], $request->status());
    }

    public function sendOrderToKlever(Request $request, OrdersProviderContract $adapter)
    {
        $api_url = config('app.instntly.base_uri');
        $response = Http::withHeaders([
            'Authorization' => $request->token,
        ])->post($api_url . '/fundOrders/fundOrder',
        [
            "amount" => $request->amount,
            "externalId" => $request->id,
            "merchantCode" => $request->merchant_id,
            "notes" => $request->notes,
            "type" => "StoreCredit",
            "userEmail" => $request->email,
            "userFirstName" => $request->name,
            "userLastName" => $request->lastName
        ]);

        if ($response->ok()) {
            // $refund = new Refund;
            // $refund->amount = $request->amount;
            // $refund->externalId = $request->id;
            // $refund->merchant_id = $request->merchant_id;
            // $refund->merchant_id = $request->integration_id;
            // $refund->save();
            return response()->json($response->collect()['fundOrder'], 200);
        }

        return response()->json(["error" => true, "message" => $request->collect()['message']], $request->status());

    }
}
