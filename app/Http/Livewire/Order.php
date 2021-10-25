<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Managers\OrdersProviderManager;
use Illuminate\Support\Facades\Validator;

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
    public $goingToRefundTax;
    public $goingToRefundShipping;
    public $refundTotal;

    protected $listeners = [
        "goingToRefundTaxUpdate",
        "goingToRefundShippingUpdate"
    ];

    protected $rules = [
        'customerEmail' => 'required|email',
    ];

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
        $this->itemsSubtotal = 0;
        $this->totalTax = $data->order->total_tax;
        $this->totalShipping = $data->order->total_shipping;
        $this->goingToRefundTax = false;
        $this->goingToRefundShipping = false;
        $this->refundTotal = 0;
    }

    public function refundWithInstntly()
    {
        
        $manager = new OrdersProviderManager();
        $shopAdapter = $manager->resolve($this->adapter);
        $shopAdapter->setShop($this->shop);
        $itemsRefunded = [];
        $refundData = new \stdClass;
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
        $refundData->itemsRefunded = $itemsRefunded;
        $refundData->shipping = ['refund' => $this->goingToRefundShipping, 'amount' => $this->totalShipping];
        $refundData->tax = ['refund' => $this->goingToRefundTax, 'amount' => $this->totalTax];
        $refundData->refundTotal = $this->refundTotal;
        $this->refundResponse = $shopAdapter->issueRefundForOrder($this->orderId, $refundData, $this->orderNote, $this->customerEmail);
        
    }
    public function updated($propertyName)
    {
        $this->validate();
    }
    public function updateSelectedItems($item, $qty)
    {
        $this->selectedItems[$item] = $qty;
        $totalItems = 0;
        $subTotal = 0;
        $this->orderItems = $this->orderItems->map(function($orderItem) use ($item, $qty, &$subTotal){
            if ($orderItem['id'] == $item) {
                $orderItem['amount'] = $orderItem['price'] * $qty;
            }
            $subTotal = $subTotal + (isset($orderItem['amount']) ? $orderItem['amount'] : 0);
            return $orderItem;
        });

        $this->itemsSubtotal = $subTotal;
        $this->refundTotal = $subTotal;
        
        if ($this->goingToRefundTax) {
            $this->refundTotal += $this->totalTax;
        }

        if ($this->goingToRefundShipping) {
            $this->refundTotal += $this->totalShipping;
        }

        foreach ($this->selectedItems as $item) {
            $totalItems += $item;
        }
        $this->itemsCount = $totalItems;
    }

    public function goingToRefundTaxUpdate()
    {
        $this->goingToRefundTax ? $this->refundTotal += $this->totalTax : $this->refundTotal -= $this->totalTax;
    }

    public function goingToRefundShippingUpdate()
    {
        $this->goingToRefundShipping ? $this->refundTotal += $this->totalShipping : $this->refundTotal -= $this->totalShipping;
    }
    
    public function render()
    {
        return view('livewire.order');
    }
}
