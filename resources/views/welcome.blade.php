@extends('layouts.app', ['pageSlug' => 'dashboard'])
@section('styles')
@endsection

@section('content')
  <div data-elementor-type="wp-post" data-elementor-id="7719" class="elementor elementor-7719" data-elementor-settings="[]">
    <div class="elementor-section-wrap">
    <section class="elementor-section elementor-top-section elementor-element elementor-element-5bb7c09 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="5bb7c09" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
  <div class="elementor-container elementor-column-gap-default">
  <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-3b1e4c2" data-id="3b1e4c2" data-element_type="column">
  <div class="elementor-widget-wrap elementor-element-populated">
      <div class="elementor-element elementor-element-aa52057 elementor-widget elementor-widget-image" data-id="aa52057" data-element_type="widget" data-widget_type="image.default">
  <div class="elementor-widget-container">
                    <img src="https://instntly.app/wp-content/uploads/elementor/thumbs/instntly_web-pcqjxwj7pl5yxp93iqzz30l8we8xwi06vludmugk2s.png" title="instntly_web" alt="instntly_web" />															</div>
  </div>
  </div>
  </div>
  <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-ca33a20" data-id="ca33a20" data-element_type="column">
  <div class="elementor-widget-wrap">
        </div>
  </div>
    </div>
  </section>
  <section class="elementor-section elementor-top-section elementor-element elementor-element-8056e8d elementor-section-full_width elementor-section-height-full elementor-section-height-default elementor-section-items-middle" data-id="8056e8d" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
    <div class="elementor-background-overlay"></div>
    <div class="elementor-container elementor-column-gap-default">
  <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-448c6aa" data-id="448c6aa" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
  <div class="elementor-widget-wrap elementor-element-populated">
  <div class="elementor-background-overlay"></div>
      <div class="elementor-element elementor-element-85bb65e elementor-invisible elementor-widget elementor-widget-heading" data-id="85bb65e" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInDown&quot;,&quot;_animation_mobile&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
  <div class="elementor-widget-container">
  <h2 class="elementor-heading-title elementor-size-default">Delight customers by refunding them fast via a virtual instacard.</h2>		</div>
  </div>
  <div class="elementor-element elementor-element-2d607fd elementor-widget elementor-widget-spacer" data-id="2d607fd" data-element_type="widget" data-widget_type="spacer.default">
  <div class="elementor-widget-container">
  <div class="elementor-spacer">
  <div class="elementor-spacer-inner"></div>
  </div>
  </div>
  </div>
  <div class="elementor-element elementor-element-ca19c82 elementor-widget elementor-widget-spacer" data-id="ca19c82" data-element_type="widget" data-widget_type="spacer.default">
  <div class="elementor-widget-container">
  <div class="elementor-spacer">
  <div class="elementor-spacer-inner"></div>
  </div>
  </div>
  </div>
  <div class="elementor-element elementor-element-3dee384 elementor-mobile-align-right elementor-align-left elementor-widget elementor-widget-button" data-id="3dee384" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
  @if (!Auth::user()->merchant_id)
  <div class="elementor-button-wrapper">
    <a  href="{{config('app.instntly.dashboard_url')}}/signUp?fromCommercePlatform=shopify&shopifyLink={{Auth::user()->name}}" target="_blank" class="elementor-button-link elementor-button elementor-size-md" role="button">
    <span class="elementor-button-content-wrapper">
    <span class="elementor-button-text">Create a Free Account</span>
    </span>
    </a>
    </div>
  @else
  <div class="elementor-button-wrapper">
    <a href="{{config('app.instntly.dashboard_url')}}" target="_blank" class="elementor-button-link elementor-button elementor-size-md" role="button">
    <span class="elementor-button-content-wrapper">
    <span class="elementor-button-text">Go to Instntly Dashboard</span>
    </span>
    </a>
    </div>
  @endif
    </div>
    </div>
  </div>
  </div>
  <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-b8b7149" data-id="b8b7149" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_gallery&quot;:[],&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_duration&quot;:5000,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;background_slideshow_transition_duration&quot;:500}">
  <div class="elementor-widget-wrap elementor-element-populated">
      <div class="elementor-element elementor-element-7079502 elementor-widget elementor-widget-image" data-id="7079502" data-element_type="widget" data-widget_type="image.default">
  <div class="elementor-widget-container">
  </div>
  </div>
  </div>
    </div>
  </section>
  </div>
  </div>
  <script>document.body.classList.remove("no-js");</script>	<script>
  if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
  document.body.classList.add( 'is-IE' );
  }
  </script>
  <link rel='stylesheet' id='e-animations-css'  href='https://instntly.app/wp-content/plugins/elementor/assets/lib/animations/animations.min.css?ver=3.4.3' media='all' />
  <script id='ce4wp_form_submit-js-extra'>
  var ce4wp_form_submit_data = {"siteUrl":"https:\/\/instntly.app","url":"https:\/\/instntly.app\/wp-admin\/admin-ajax.php","nonce":"0ef6ffd196","listNonce":"368f5ae3a7","activatedNonce":"e675e1c4d7"};
  </script>
  <script src='https://instntly.app/wp-content/plugins/creative-mail-by-constant-contact/assets/js/block/submit.js?ver=1630854958' id='ce4wp_form_submit-js'></script>
  <script id='twenty-twenty-one-ie11-polyfills-js-after'>
  ( Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach ) || document.write( '<script src="https://instntly.app/wp-content/themes/twentytwentyone/assets/js/polyfills.js?ver=1.4"></scr' + 'ipt>' );
  </script>
  <script src='https://instntly.app/wp-content/themes/twentytwentyone/assets/js/responsive-embeds.js?ver=1.4' id='twenty-twenty-one-responsive-embeds-script-js'></script>
  <script src='https://instntly.app/wp-includes/js/wp-embed.min.js?ver=5.8.1' id='wp-embed-js'></script>
  <script src='https://instntly.app/wp-content/plugins/elementor-pro/assets/js/webpack-pro.runtime.min.js?ver=3.4.1' id='elementor-pro-webpack-runtime-js'></script>
  <script src='https://instntly.app/wp-content/plugins/elementor/assets/js/webpack.runtime.min.js?ver=3.4.3' id='elementor-webpack-runtime-js'></script>
  <script src='https://instntly.app/wp-content/plugins/elementor/assets/js/frontend-modules.min.js?ver=3.4.3' id='elementor-frontend-modules-js'></script>
  <script id='elementor-pro-frontend-js-before'>
  var ElementorProFrontendConfig = {"ajaxurl":"https:\/\/instntly.app\/wp-admin\/admin-ajax.php","nonce":"2ddbf9b231","urls":{"assets":"https:\/\/instntly.app\/wp-content\/plugins\/elementor-pro\/assets\/","rest":"https:\/\/instntly.app\/wp-json\/"},"i18n":{"toc_no_headings_found":"No headings were found on this page."},"shareButtonsNetworks":{"facebook":{"title":"Facebook","has_counter":true},"twitter":{"title":"Twitter"},"google":{"title":"Google+","has_counter":true},"linkedin":{"title":"LinkedIn","has_counter":true},"pinterest":{"title":"Pinterest","has_counter":true},"reddit":{"title":"Reddit","has_counter":true},"vk":{"title":"VK","has_counter":true},"odnoklassniki":{"title":"OK","has_counter":true},"tumblr":{"title":"Tumblr"},"digg":{"title":"Digg"},"skype":{"title":"Skype"},"stumbleupon":{"title":"StumbleUpon","has_counter":true},"mix":{"title":"Mix"},"telegram":{"title":"Telegram"},"pocket":{"title":"Pocket","has_counter":true},"xing":{"title":"XING","has_counter":true},"whatsapp":{"title":"WhatsApp"},"email":{"title":"Email"},"print":{"title":"Print"}},"facebook_sdk":{"lang":"en_US","app_id":""},"lottie":{"defaultAnimationUrl":"https:\/\/instntly.app\/wp-content\/plugins\/elementor-pro\/modules\/lottie\/assets\/animations\/default.json"}};
  </script>
  <script src='https://instntly.app/wp-content/plugins/elementor-pro/assets/js/frontend.min.js?ver=3.4.1' id='elementor-pro-frontend-js'></script>
  <script src='https://instntly.app/wp-content/plugins/elementor/assets/lib/waypoints/waypoints.min.js?ver=4.0.2' id='elementor-waypoints-js'></script>
  <script src='https://instntly.app/wp-includes/js/jquery/ui/core.min.js?ver=1.12.1' id='jquery-ui-core-js'></script>
  <script src='https://instntly.app/wp-content/plugins/elementor/assets/lib/swiper/swiper.min.js?ver=5.3.6' id='swiper-js'></script>
  <script src='https://instntly.app/wp-content/plugins/elementor/assets/lib/share-link/share-link.min.js?ver=3.4.3' id='share-link-js'></script>
  <script src='https://instntly.app/wp-content/plugins/elementor/assets/lib/dialog/dialog.min.js?ver=4.8.1' id='elementor-dialog-js'></script>
  <script id='elementor-frontend-js-before'>
  var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnTwitter":"Share on Twitter","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Extra","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Extra","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Widescreen","value":2400,"default_value":2400,"direction":"min","is_enabled":false}}},"version":"3.4.3","is_static":false,"experimentalFeatures":{"e_dom_optimization":true,"a11y_improvements":true,"e_import_export":true,"additional_custom_breakpoints":true,"landing-pages":true,"elements-color-picker":true,"admin-top-bar":true,"form-submissions":true},"urls":{"assets":"https:\/\/instntly.app\/wp-content\/plugins\/elementor\/assets\/"},"settings":{"page":[],"editorPreferences":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","lightbox_title_src":"title","lightbox_description_src":"description"},"post":{"id":7719,"title":"Shopify%20%E2%80%93%20Instntly%20%E2%80%A2%C2%A0Refunds%2C%20fast.","excerpt":"","featuredImage":false}};
  </script>
  <script src='https://instntly.app/wp-content/plugins/elementor/assets/js/frontend.min.js?ver=3.4.3' id='elementor-frontend-js'></script>
  <script src='https://instntly.app/wp-content/plugins/elementor-pro/assets/js/preloaded-elements-handlers.min.js?ver=3.4.1' id='pro-preloaded-elements-handlers-js'></script>
  <script src='https://instntly.app/wp-content/plugins/elementor/assets/js/preloaded-modules.min.js?ver=3.4.3' id='preloaded-modules-js'></script>
  <script src='https://instntly.app/wp-content/plugins/elementor-pro/assets/lib/sticky/jquery.sticky.min.js?ver=3.4.1' id='e-sticky-js'></script>
  <script src='https://instntly.app/wp-includes/js/underscore.min.js?ver=1.13.1' id='underscore-js'></script>
  <script id='wp-util-js-extra'>
  var _wpUtilSettings = {"ajax":{"url":"\/wp-admin\/admin-ajax.php"}};
  </script>
  <script src='https://instntly.app/wp-includes/js/wp-util.min.js?ver=5.8.1' id='wp-util-js'></script>
  <script id='wpforms-elementor-js-extra'>
  var wpformsElementorVars = {"captcha_provider":"recaptcha","recaptcha_type":"v2"};
  </script>
  <script src='https://instntly.app/wp-content/plugins/wpforms-lite/assets/js/integrations/elementor/frontend.min.js?ver=1.6.9' id='wpforms-elementor-js'></script>
  <script>
  /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
  </script>

@endsection

@section('scripts')
    @parent

    <script>
        actions.TitleBar.create(app, { title: 'Dashboard' });
    </script>
@endsection
