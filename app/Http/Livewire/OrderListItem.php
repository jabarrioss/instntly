<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrderListItem extends Component
{
    public $item;

    public $amount;

    public $quantity;

    public function mount($item)
    {
        $this->item = (array) $item;
        $this->itemId = $item->id;
        $this->price = $item->price;
        $this->quantity = 0;
        $this->amount = 0;
    }

    public function updatedQuantity($qty)
    {
        $this->amount = $this->price * $qty;
    }

    public function testingEvent()
    {
        $data = [
            'product_id' => $this->itemId
        ];
        $this->emit("selectedItems", $data);
    }

    public function render()
    {
        return view('livewire.order-list-item');
    }
}
