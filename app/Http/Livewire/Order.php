<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Managers\OrdersProviderManager;

class Order extends Component
{
    protected $data;
    protected $order;
    
    public $customerEmail;
    public $adapter;
    public $orderItems;
    public $orderId;
    public $orderNumber;
    public $selectedItems;
    public $itemsCount;
    public $orderNote;
    public $refundResponse;

    public function mount($orderId, $adapter = null, $shop = null)
    {
        $adapter = isset($adapter) ? $adapter : request()->adapter;
        $shop = isset($shop) ? $shop : request()->shop;
        $manager = new OrdersProviderManager();
        $shopAdapter = $manager->resolve($adapter);
        $shopAdapter->setShop($shop);
        $data = $shopAdapter->getOrderById($orderId);
        
        $this->adapter = $adapter;
        $this->shop = $shop;
        $this->data = $data;
        $this->order = $data->order;
        $this->customerEmail = $data->order->customer_email ?? "";
        $this->orderId = $data->order->id;
        $this->orderNumber = $data->order->number;
        $this->orderItems = collect($data->order->items)->map(function($item){ return (array) $item;});
        $this->selectedItems = [];
        $this->itemsCount = 0;
        $this->orderNote = "";
        $this->refundResponse = ["status" => "", "message" => ""];
    }

    public function refundWithInstntly()
    {
        $manager = new OrdersProviderManager();
        $shopAdapter = $manager->resolve($this->adapter);
        $shopAdapter->setShop($this->shop);
        $itemsRefunded = [];
        foreach ($this->orderItems as $orderItem) {
            foreach ($this->selectedItems as $selectedItem => $qty) {
                if ($orderItem['id'] == $selectedItem && $qty > 0) {
                    $itemsRefunded[] = [
                        'name' => $orderItem['title'],
                        'quantity' => $qty,
                        'unit_price' => $orderItem['price'],
                        'total_refunded' => $orderItem['amount'],
                    ];
                }
            }
        }
        $this->refundResponse =  $shopAdapter->issueRefundForOrder($this->orderId, $itemsRefunded, $this->orderNote, $this->customerEmail);
        
    }

    public function updateSelectedItems($item, $qty)
    {
        $this->selectedItems[$item] = $qty;
        $totalItems = 0;
        $this->orderItems = $this->orderItems->map(function($orderItem) use ($item, $qty){
            if ($orderItem['id'] == $item) {
                $orderItem['amount'] = $orderItem['price'] * $qty;
            }
            return $orderItem;
        });

        foreach ($this->selectedItems as $item) {
            $totalItems += $item;
        }

        $this->itemsCount = $totalItems;
    }
    
    public function render()
    {
        return view('livewire.order');
    }
}
