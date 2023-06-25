<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
  @include('layouts.parts.head')
  
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  @yield('header_extra')
</head>
	<body>
    <div id="ajaxLoader" style="display:none;">
        <img id="loading-image" src="{{ asset('frontend/img/loading.gif') }}" />
    </div>

    <div class="toast" id="alertSuccess" style="display:none;">
        <div class="toast-body"  id="alertSuccessMsg"></div>
    </div>

    <div class="toast" id="alertDanger" style="display:none;">
        <div class="toast-body"  id="alertDangerMsg"></div>
    </div>
    
    @yield('content')

    @include('layouts.parts.script')

    @yield('footer_extra')

	</body>

</html>