<?php

namespace App\Helpers;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\Session;

trait ShopifyOauth
{
    public static function getOauthUrl($shop)
    {
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
        return $redirect;
        }else {
            // We now have a code, lets grab the access token
            $api->requestAndSetAccess($code);
            // You can now make API calls
             $request = $api->rest('GET', '/admin/shop.json'); // or GraphQL
        }
    }
}
