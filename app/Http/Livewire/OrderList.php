<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrderList extends Component
{
    public $order;
    public $orders;
    public $customerEmail;
    public $adapter;
    public $orderItems;
    public $orderId;
    public $orderNumber;
    public $selectedItems;
    public $itemsCount;
    public $orderNote;
    public $refundResponse;

    public function mount(array $orders)
    {
        $this->orders = collect($orders)->map(function($order){ return (array) $order;});
        $this->orderId = $this->orders->first()['order']->id;
    }
    
    public function render()
    {
        return view('livewire.order-list');
    }

    public function fetchOrder($orderId)
    {
        $this->customerEmail = "dianelita@gmail.com";
        $this->orderId = 1;
        $this->orderNumber = "doce";
        // $this->orderItems = 
        $this->selectedItems = [];
        $this->itemsCount = 0;
        $this->orderNote = "";
    }
}
