@extends('layouts.app', ['pageSlug' => 'dashboard'])
@section('styles')
@endsection

@section('content')

        <div>{{now()}}</div>
        <div><a href="{{secure_url('orders/shopify/index').'?shop='.Auth::user()->name }}">Get Orders</a></div>
        <div><a href="{{secure_url('test?adapter=shopify&shop=test-store692021.myshopify.com')}}">TestsController</a></div>
        <!-- TITLE -->
        <section id="title">
            <div class="jumbotron">
              
              <div class="container-fluid">
                <h1>KLEVER</h1>
              </div><!-- .container-fluid -->
            
            </div><!-- .jumbotron -->
          </section><!-- #title -->
          <!-- END TITLE-->
@endsection

@section('scripts')
    @parent

    <script>
        actions.TitleBar.create(app, { title: 'Dashboard' });
    </script>
@endsection
