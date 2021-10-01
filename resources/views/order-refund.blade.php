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

    <body>
	<!-- HEADER -->
	<main>
            <section id="title">
                <div class="jumbotron">
                
                <div class="container-fluid">
                    <h1>Instntly</h1>
                </div><!-- .container-fluid -->
                <a class="btn btn-primary" href="" data-toggle="modal" data-target="#modalRefund">Refund Modal</a>
                
                </div><!-- .jumbotron -->
            </section><!-- #title -->
            <!-- END TITLE-->
            <div>
                <livewire:order :orderId="$order->order->id" > 
            </div>
        </main>
  
  
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ secure_asset('assets/js/bootstrap.min.js') }}"></script>
    
          @if (isset(request()->adapter) && request()->adapter == "shopify")
              @include("includes.shopify-scaffolding")
          @endif
  
          @livewireScripts
          @yield('scripts')
        
        <script>
            actions.TitleBar.create(app, { title: 'Issue Refund' });

            $(function () {
                $('#modalRefund').modal('show');
            });
        </script>
      </body>
  </html>
  
