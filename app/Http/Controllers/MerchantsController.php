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
            $model = $class::create($request->except('shopifyLink'));
            $integration = new User;
            $integration->name = $request->shopifyLink;
            $integration->email = $request->shopifyLink;
            $integration->save();
    
            $mint = new Mint;
            $mint->merchant_id = $model->id;
            $mint->integration_id = $integration->id;
            $mint->label = "Shopify";
            $mint->handle = "shopify";
            $mint->adapter = "shopify";
            $mint->save();
            return $model;
        });
        return $this->modelResponse($model);
    }

}
