<?php

namespace App\Helpers;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\Session;

use App\Models\Merchant;

trait ShopifyOauth
{
    public static function getOauthUrl($shop)
    {
        $merchant_id = self::findMerchantWhoOwnsThisStore();
        $options = new Options();
        $options->setVersion(config('shopify-app.api_version'));
        $options->setApiKey(config('shopify-app.api_key'));
        $options->setApiSecret(config('shopify-app.api_secret'));

        // Create the client and session
        $api = new BasicShopifyAPI($options);
        // $api->setSession(new Session($_SESSION['shop']));
        $api->setSession(new Session($shop));

        $code = isset($_GET['code']) ? $_GET['code'] : null;
        if (!$code) {
        /**
         * No code, send user to authorize screen
         * Pass your scopes as an array for the first argument
         * Pass your redirect URI as the second argument
         */
        $redirect = $api->getAuthUrl(config('shopify-app.api_scopes'), config('shopify-app.api_redirect'));
        // $redirect = $redirect."&merchant_id=".$merchant_id;
        return $redirect;
        }else {
            // We now have a code, lets grab the access token
            $api->requestAndSetAccess($code);
            // You can now make API calls
        }
    }

    public static function findMerchantWhoOwnsThisStore($shopDomain = null)
    {
        if (request()->has('merchant_id')) {
            return request()->merchant_id;
        }

        if (request()->has('username')) {
            $merchant = Merchant::where("username", request()->username)->first();
            if (!is_null($merchant)) {
                return $merchant->id;
            }
        }

        if(session()->has('merchant_id')){
            return session('merchant_id');
        }
        
        if (session()->has('shopData')) {
            $shopData = session('shopData');
            return $shopData['merchant_id'];
        }
    }
}
