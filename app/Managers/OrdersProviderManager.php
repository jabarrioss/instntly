<?php

namespace App\Managers;

use App\Adapters\AkauntingAdapter;
use App\Adapters\ShopifyAdapter;
use Illuminate\Support\Str;

class OrdersProviderManager
{
    public function resolve($adapter)
    {
        $methodName = 'resolve'.ucfirst(Str::camel($adapter));
        if (method_exists($this, $methodName)) {
            switch($adapter){
                case 'shopify':
                    $adapter = call_user_func_array([$this, $methodName], [$adapter]);
                    $adapter->setAuth(auth()->user(), "");
                    break;
                case 'akaunting':
                    $adapter = call_user_func_array([$this, $methodName], [$adapter]);
                    break;
                default:
                    throw new \RuntimeException('Unknown '.$adapter.' provider manager adapter');
            }
            return $adapter;
        }
    }
    
    public function resolveShopify($adapter)
    {
        return new ShopifyAdapter($adapter);
    }

    public function resolveAkaunting($adapter)
    {
        $adapter = new AkauntingAdapter($adapter);
        $merchant = auth()->user();
        $integrations = $merchant->integrations()
            ->where("adapter", "akaunting")
            ->first();
        $client = $integrations
        ->integrations()
        ->first();
        $adapter->setAuth($client->email, $client->password);
        return $adapter;
    }
}
