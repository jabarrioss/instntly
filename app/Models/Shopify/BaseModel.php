<?php

namespace App\Models\Shopify;

class BaseModel
{
    protected $api_version;

    protected $base_uri;
    
    protected $shop;

    protected $resource;

    public function __construct($shop, $resource)
    {
        $this->shop = $shop;
        $this->resource = $resource;
        $this->api_version = config('shopify-app.api_version');
        $this->base_uri = "/admin/api/" . $this->api_version . "/";
    }

    public function getResource()
    {
        return $this->resource;
    }
}
