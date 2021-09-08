<?php

namespace App\Managers;

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
                    $adapter->setAuth(request()->shop, "");
                    break;
                default:
                    throw new \RuntimeException('Unknown orders provider manager adapter');
            }
            return $adapter;
        }
    }
    
    public function resolveShopify($adapter)
    {
        return new ShopifyAdapter($adapter);
    }
}
