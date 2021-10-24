<?php

namespace App\Helpers\Traits;

use App\Models\Refund;
use Illuminate\Support\Facades\Http;
use App\Clients\AwsClient;

trait Refunds
{
    public function sendOrderToInstntly($data, $merchant)
    {
        if (config('app.env') == 'local') {
            $cognito_response = Http::post(config('app.instntly.base_uri')."/auth/login", 
            [
                "email"=> "merchant01@kleverlabs.com",
                "password"=> "zxcvbnm1"
            ]);

            if ($cognito_response->status() == 200) {
                $token = $cognito_response->collect()['token'];
            }else{
                return ["error" => true, "message" => $cognito_response->collect()['message']['message']];
            }
        }else{
            $awsClient =  app()->make(AwsClient::class);
            $cognito_response = $awsClient->getNewAccessTokenByRefreshToken($merchant->username, $merchant->refresh_token);
            $responseData = $cognito_response->get("AuthenticationResult");
            $token = $responseData["IdToken"];
        }
        $refund_request = [
            "amount" => $data->amount,
            "externalId" => $data->orderId,
            "merchantCode" => $merchant->username,
            "notes" => $data->notes,
            "type" => "StoreCredit",
            "userEmail" => $data->email,
            // "userFirstName" => $data->name,
            // "userLastName" => $data->lastName
        ];
        $api_url = config('app.instntly.base_uri');
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post($api_url . '/fundOrders/fundOrder', $refund_request);
        if ($response->ok()) {
            return ["error" => false, "fundOrderId" => $response->collect()['fundOrder']['fundOrderId']];
        }

        return ["error" => true, "message" => $response->collect()['message']];
    }
}
