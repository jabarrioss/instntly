@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
            <section id="title">
                <div class="jumbotron">
                
                <div class="container-fluid">
                    <h1>KLEVER</h1>
                </div><!-- .container-fluid -->
                <a class="btn btn-primary" href="" data-toggle="modal" data-target="#modalRefund">Refund Modal</a>
                
                </div><!-- .jumbotron -->
            </section><!-- #title -->
            <!-- END TITLE-->
            <div>
                <livewire:order :orderId="$order->order->id" > 
            </div>
@endsection
