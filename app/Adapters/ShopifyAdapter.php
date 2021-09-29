<?php

namespace App\Adapters;

use App\Contracts\OrdersProviderContract;
use App\Models\Shopify\ShopifyOrder;
use App\Contracts\OrderContract;
use App\Helpers\Traits\Refunds;
use App\Models\Merchant;
use App\Models\User;
use Exception;
use stdClass;

class ShopifyAdapter implements OrdersProviderContract
{
    use Refunds;

    public $shop;
    
    public $api_version;
    
    public $base_uri;
    
    public function __construct($adapter)
    {
        $this->api_version = config('shopify-app.api_version');
        $this->base_uri = "/admin/api/" . $this->api_version . "/";

    }

    public function setAuth($user, $pass)
    {
        if (!is_null($user) && $user instanceof Merchant) {
            $integrations = $user->integrations()
            ->where("adapter", "shopify")
            /**
             * I'm only fetching the first shop by request of instntly, this could be
             * replaced for ->get() to get an array of stores
             * */
            ->first();
            $this->shop = $integrations->integrations()->first();
        }else{
            $this->shop = User::where('name', request()->shop)->first();
        }
    }

    public function getOrderById($orderId) : OrderContract
    {
        $order = $this->shop
        ->api()
        ->rest('GET', "/admin/api/". $this->api_version ."/orders/$orderId.json")['body']['order'];
        return new ShopifyOrder($this->shop, $order);
    }

    public function getOrders()
    {
        $request = $this->shop
        ->api()
        ->rest('GET', "/admin/api/". $this->api_version ."/orders.json", ['fields' => 'id,name,current_subtotal_price']);
        if($request['status'] == 200 && !$request['errors']){
            $orders = $request['body']['orders'];
            $ordersCollection = collect();
            foreach ($orders as $order) {
                $ordersCollection->push(new ShopifyOrder($this->shop, $order));
            }
            return $ordersCollection;
        }else{
            throw new Exception("There's some error in the request: ". $request['body'], $request['status']);
        }
    }

    public function setShop($shop)
    {
        $this->shop = User::where('name', $shop)->first();
    }

    public function issueRefundForOrder($orderId, $itemsRefunded, $orderNote = "", $customerEmail)
    {
        /**
         * Here we fetch the order again from the shopify API 
         * so we can use some of the properties
         * we need for the refund
         */

        $order = $this->getOrderById($orderId);
        $orderNote.= "\n" . "Refunded via Instntly";
        $orderNote.= "\n" . "Refunded Items: ";
        $totalRefunded = 0;
        foreach ($itemsRefunded as $item) {
            $orderNote.= "\n" . "------------------------";
            $orderNote.= "\n" ."Name: " . $item['name'];
            $orderNote.= "\n "."Quantity: " . $item['quantity'];
            $orderNote.= "\n "."Unit Price: " . $item['unit_price'];
            $orderNote.= "\n "."Total amount Refunded: " . $item['total_refunded'];
            $orderNote.= "\n" . "------------------------";
            $totalRefunded += $item['total_refunded'];
        }
        $orderNote.= "\n" . "Total Refunded: " . $totalRefunded ;

        $orderNote.= "\n" . $order->getResource()['note'];

        $data = new stdClass;
        $data->amount = $totalRefunded;
        $data->orderId = $order->getResource()['id'];
        $data->notes = $orderNote;
        $data->email = $customerEmail;
        $data->name = $customerEmail;
        $data->lastName = $customerEmail;
        $data->merchant_id = $this->shop->merchant->id;
        $data->integration_id = $this->shop->id;
        $refundResponse = $this->sendOrderToKlever($data, $this->shop->merchant);
        if ($refundResponse['error']) {
            return ["status" => "error", "message" => $refundResponse['message']];
        }

        $orderNote.= "\n" . "Refund Order Id: " . $refundResponse['fundOrderId'] ;
        $request = $this->shop
            ->api()
            ->rest('PUT', "/admin/api/". $this->api_version ."/orders/$orderId.json", [
                'order' => [
                    'id' => $orderId,
                    'note' => $orderNote,
                    "tags" => [
                        "Refunded via Instntly"
                        ]
                    ]
                ]
        );
        return ["status" => "ok", "message" => "Order Refunded succesfully"];

    }
}
