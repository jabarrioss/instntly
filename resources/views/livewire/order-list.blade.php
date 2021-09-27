<div class="panel panel-default">
  <!-- Default panel contents -->
  <!-- Table -->
  <table class="table">
    <thead>
        <th>Order #</th>
        <th>Amount</th>
        <th>Actions</th>
    </thead>
    <tbody>
        @foreach ($orders as $order)
          <tr>
              <td>{{$order['order']->number ?? $order['order']['number']}}</td>
              <td>${{$order['order']->subTotal ?? $order['order']['subTotal']}}</td>
              <td>
              <button 
              wire:click="fetchOrder({{$orderId}})" 
              class="btn btn-primary" data-toggle="modal" data-target="#modalRefund"
               >Refund Modal</button>
              </td>
          </tr>
          @endforeach
    </tbody>
  </table>
</div>