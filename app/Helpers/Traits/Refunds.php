<?php

namespace App\Helpers\Traits;

use App\Models\Refund;
use Illuminate\Support\Facades\Http;
use App\Clients\AwsClient;

trait Refunds
{
    public function sendOrderToKlever($data, $merchant)
    {
        if (config('app.env') == 'local') {
            $response = Http::post("https://dev-api.kleverpay.app/auth/login", 
            [
                "email"=> "merchant01@kleverlabs.com",
                "password"=> "zxcvbnm1"
            ]);

            $token = $response->collect()['token'];
        }else{
            $awsClient =  app()->make(AwsClient::class);
            $response = $awsClient
            ->getNewAccessTokenByRefreshToken($merchant->username, $merchant->refresh_token);
            $responseData = $response->get("AuthenticationResult");
            $token = $responseData["AccessToken"];
        }
        $api_url = config('app.instntly.base_uri');
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post($api_url . '/fundOrders/fundOrder',
        [
            "amount" => $data->amount,
            "externalId" => $data->orderId,
            "merchantCode" => $merchant->username,
            "notes" => $data->notes,
            "type" => "StoreCredit",
            "userEmail" => $data->email,
            // "userFirstName" => $data->name,
            // "userLastName" => $data->lastName
        ]);

        if ($response->ok()) {
            return ["error" => false, "fundOrderId" => $response->collect()['fundOrder']['fundOrderId']];
        }

        return ["error" => true, "message" => $response->collect()['message']];
    }
}
