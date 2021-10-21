<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Merchant;
use App\Models\Mint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;

class MerchantsController extends BaseController
{
    protected $class = Merchant::class;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validateRequest($request);
        if($validator) { return $validator; }

        
        $model = DB::transaction(function () use ($request) {
            $class = $this->class;
            $model = $class::firstOrCreate([
                    "username" => $request->username
                ],
                $request->except('shopifyLink')
            );

            Mint::firstOrCreate(
                [
                    "label" => (new ShopDomain($request->shopifyLink))->toNative()
                ],
                [
                    'handle' => 'shopify',
                    'adapter' => 'shopify',
                    'merchant_id' => $model->id
                ]);
            return [
                "oauth_url" => User::getOauthUrl($request->shopifyLink),
                "merchant" => $model,
            ];
        });
        return $this->modelResponse($model);
    }

}
