<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
		<title>Issue Refund</title>
<meta name="robots" content="max-image-preview:large">
		<script>
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.1.0\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.1.0\/svg\/","svgExt":".svg","source":{"concatemoji":"http:\/\/\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.8.1"}};
			!function(e,a,t){var n,r,o,i=a.createElement("canvas"),p=i.getContext&&i.getContext("2d");function s(e,t){var a=String.fromCharCode;p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,e),0,0);e=i.toDataURL();return p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,t),0,0),e===i.toDataURL()}function c(e){var t=a.createElement("script");t.src=e,t.defer=t.type="text/javascript",a.getElementsByTagName("head")[0].appendChild(t)}for(o=Array("flag","emoji"),t.supports={everything:!0,everythingExceptFlag:!0},r=0;r<o.length;r++)t.supports[o[r]]=function(e){if(!p||!p.fillText)return!1;switch(p.textBaseline="top",p.font="600 32px Arial",e){case"flag":return s([127987,65039,8205,9895,65039],[127987,65039,8203,9895,65039])?!1:!s([55356,56826,55356,56819],[55356,56826,8203,55356,56819])&&!s([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]);case"emoji":return!s([10084,65039,8205,55357,56613],[10084,65039,8203,55357,56613])}return!1}(o[r]),t.supports.everything=t.supports.everything&&t.supports[o[r]],"flag"!==o[r]&&(t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&t.supports[o[r]]);t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&!t.supports.flag,t.DOMReady=!1,t.readyCallback=function(){t.DOMReady=!0},t.supports.everything||(n=function(){t.readyCallback()},a.addEventListener?(a.addEventListener("DOMContentLoaded",n,!1),e.addEventListener("load",n,!1)):(e.attachEvent("onload",n),a.attachEvent("onreadystatechange",function(){"complete"===a.readyState&&t.readyCallback()})),(n=t.source||{}).concatemoji?c(n.concatemoji):n.wpemoji&&n.twemoji&&(c(n.twemoji),c(n.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>
		<style>img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}</style>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="{{ secure_asset('assets/img/Mblue.ico')}}">
	<title>Checkout Modal</title>
    <link rel="stylesheet" id="elementor-frontend-css" href="{{secure_asset('css/refunds-page.css')}}" media="all">
	 <!-- GOOGLE FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Josefin+Sans|Tangerine' rel='stylesheet' type='text/css'>
	<!-- Bootstrap -->
	<link href="{{ secure_asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<!-- FontAwesome Icons -->
    <link href="{{ secure_asset('assets/css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="{{ secure_asset('assets/css/style.css')}}" rel="stylesheet">

<style>.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
@livewireStyles
@yield('styles')
</head>
<body class="page-template page-template-elementor_canvas page page-id-6 wp-embed-responsive is-light-theme no-js singular elementor-default elementor-template-canvas elementor-kit-5 elementor-page elementor-page-6">
			<div data-elementor-type="wp-page" data-elementor-id="6" class="elementor elementor-6" data-elementor-settings="[]">
							<div class="elementor-section-wrap">
							<section class="elementor-section elementor-top-section elementor-element elementor-element-88c3018 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="88c3018" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-dc2b140" data-id="dc2b140" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-8992cfb elementor-position-top elementor-vertical-align-top elementor-widget elementor-widget-image-box" data-id="8992cfb" data-element_type="widget" data-widget_type="image-box.default">
				<div class="elementor-widget-container">
			<div class="elementor-image-box-wrapper">

                <figure class="elementor-image-box-img"><img width="1200" height="1200" src="{{secure_asset('assets/img/app_icon.png')}}" class="attachment-full size-full" alt="" loading="lazy" style="width:100%;height:100%;max-width:1200px"></figure><div class="elementor-image-box-content">
                    @if (!$shop->merchant_id)
                        <h3 class="elementor-image-box-title">Looks like you haven't linked you instntly account yet, please sign up</h3>
                    @endif
                </div>

            </div>		</div>
				</div>
				<div class="elementor-element elementor-element-d3c663b elementor-align-center elementor-widget elementor-widget-button" data-id="d3c663b" data-element_type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
                    @if ($shop->merchant_id)
                    <div class="elementor-button-wrapper">
                        <a href="{{config('app.instntly.dashboard_url')}}" target="_blank" class="fuentes-modal elementor-button-link elementor-button elementor-size-md" role="button">
                        <span class="elementor-button-content-wrapper">
                        <span class="elementor-button-text">Go to Instntly Dashboard</span>
                        </span>
                        </a>
                        </div>
                    @else
                        <div class="elementor-button-wrapper">
                            <a target="_blank" href="{{config('app.instntly.dashboard_url')}}/signUp?fromCommercePlatform=shopify&shopifyLink={{$shop->name}}" class="elementor-button-link elementor-button elementor-size-lg" role="button">
                                <span class="elementor-button-content-wrapper">
                                <span class="elementor-button-text">Sign up</span>
                            </span>
                        </a>
                        </div>
                    @endif
        </div>
    </div>
					</div>
		</div>
							</div>
		</section>
						</div>
					</div>
                    @if ($shop->merchant_id)
                        <div>
                            <livewire:order :orderId="$order->order->id" > 
                        </div>
                    @endif
		<script>document.body.classList.remove("no-js");</script>	<script>
	if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
		document.body.classList.add( 'is-IE' );
	}
	</script>
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