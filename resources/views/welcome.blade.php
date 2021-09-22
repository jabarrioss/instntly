@extends('layouts.app', ['pageSlug' => 'dashboard'])
@section('styles')
@endsection

@section('content')

    <p>You are: {{ $shopDomain ?? Auth::user()->username }}</p>
    <div>{{now()}}</div>
    <div><a href="{{secure_url('orders')}}">Get Orders</a></div>
    <div><a href="{{secure_url('test?adapter=shopify&shop=test-store692021.myshopify.com')}}">TestsController</a></div>
@endsection

@section('scripts')
    @parent

    <script>
        actions.TitleBar.create(app, { title: 'Dashboard' });
    </script>
@endsection
