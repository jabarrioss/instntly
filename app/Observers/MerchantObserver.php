<?php

namespace App\Observers;

use App\Models\Merchant;
use App\Models\User;
use App\Models\Mint;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;

class MerchantObserver
{
    /**
     * Handle the Merchant "created" event.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return void
     */
    public function created(Merchant $merchant)
    {
        $shopLink = (new ShopDomain(request()->shopifyLink))->toNative();
        $shop = User::where('name', $shopLink)->first();
        if(!is_null($shop) && $shop->merchant_id == 0){
            $shop->merchant_id = $merchant->id;
            $integration = Mint::firstOrCreate(
                [
                    "label" => $shopLink
                ],
                [
                    'handle' => 'shopify',
                    'adapter' => 'shopify',
                    'merchant_id' => $merchant->id
                ]);
            $integration->integration_id = $shop->id;
            $integration->save();
            $shop->save();
        }
    }

    /**
     * Handle the Merchant "updated" event.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return void
     */
    public function updated(Merchant $merchant)
    {
        //
    }

    /**
     * Handle the Merchant "deleted" event.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return void
     */
    public function deleted(Merchant $merchant)
    {
        //
    }

    /**
     * Handle the Merchant "restored" event.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return void
     */
    public function restored(Merchant $merchant)
    {
        //
    }

    /**
     * Handle the Merchant "force deleted" event.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return void
     */
    public function forceDeleted(Merchant $merchant)
    {
        //
    }
}
