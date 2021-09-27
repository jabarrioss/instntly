@extends('layouts.app', ['pageSlug' => 'dashboard'])
@section('content')
       <!-- TITLE -->
       <section id="title">
        <div class="jumbotron">
          
            <div>{{now()}}</div>
          <div class="container-fluid">
            <h1>Orders List</h1>
          </div><!-- .container-fluid -->
        
        </div><!-- .jumbotron -->
      </section><!-- #title -->
      <!-- END TITLE-->
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
                    <td>{{$order->order->number ?? $order->order->number}}</td>
                    <td>${{$order->order->subTotal ?? $order->order->subTotal}}</td>
                    <td>
                    <a href="{{secure_url('orders/'.$adapter.'/show') .'?id='.$order->order->id.'&shop='.$shop}}" class="btn btn-primary">Refund Modal</a>
                    </td>
                </tr>
                @endforeach
          </tbody>
        </table>
      </div>
@endsection

@section('scripts')
    @parent

    <script>
        actions.TitleBar.create(app, { title: 'Orders List' });
    </script>
@endsection