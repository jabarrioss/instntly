<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Merchant;
use App\Models\Mint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

            $integration = Mint::firstOrCreate(
                [
                    "label" => $request->shopifyLink
                ],
                [
                    'handle' => 'shopify',
                    'adapter' => 'shopify',
                    'merchant_id' => $model->id
                ]);
            return [
                "mint" => $integration,
                "merchant" => $model,
                "oauth_url" => User::getOauthUrl($request->shopifyLink)
            ];
        });
        return $this->modelResponse($model);
    }

}
