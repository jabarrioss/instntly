<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="{{ secure_asset('assets/img/Mblue.ico')}}">
	<title>Checkout Modal</title>
	 <!-- GOOGLE FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Josefin+Sans|Tangerine' rel='stylesheet' type='text/css'>
	<!-- Bootstrap -->
	<link href="{{ secure_asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<!-- FontAwesome Icons -->
    <link href="{{ secure_asset('assets/css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="{{ secure_asset('assets/css/style.css')}}" rel="stylesheet">
	<!-- ..::Cr0s1v::..  -->
    @livewireStyles
    @yield('styles')

</head>

    <body class="{{ $class ?? '' }}">
	<!-- HEADER -->
	<main>
    @yield('content')
  </main>
  
  
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="{{ secure_asset('assets/js/bootstrap.min.js') }}"></script>
  
        @if (isset(request()->adapter) && request()->adapter == "shopify")
            {{-- @include("includes.shopify-scaffolding") --}}
        @endif

        @livewireScripts
        @yield('scripts')
    </body>
</html>
