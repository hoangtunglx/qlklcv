<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#ffffff" />
	<meta name="author" content="{{ config('app.manage_by', 'ĐHAG') }}" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>@yield('pagetitle', 'Trang chủ') - {{ config('app.name', 'LCMS') }}</title>
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/assets/img/favicons/apple-touch-icon.png') }}" />
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/assets/img/favicons/favicon-32x32.png') }}" />
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/img/favicons/favicon-16x16.png') }}" />
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/img/favicons/favicon.ico') }}" />
	<link rel="manifest" href="{{ asset('public/assets/img/favicons/manifest.json') }}" />
	<script src="{{ asset('public/assets/js/config.js') }}"></script>
	<script src="{{ asset('public/vendors/overlayscrollbars/OverlayScrollbars.min.js') }}"></script>
	<link rel="preconnect" href="https://fonts.gstatic.com" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
	<link rel="stylesheet" href="{{ asset('public/vendors/overlayscrollbars/OverlayScrollbars.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/vendors/fontawesome/5.14.0/css/all.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/theme390.min.css') }}" id="style-default" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/user.min.css') }}" id="user-style-default" />
</head>

<body>
	<main class="main" id="top">
		<div class="container">
			@yield('content')
		</div>
	</main>
	
	<script src="{{ asset('public/vendors/jquery/3.6.0/jquery-3.6.0.min.js') }}"></script>
	<script src="{{ asset('public/vendors/popper.js/2.9.3/popper.min.js') }}"></script>
	<script src="{{ asset('public/vendors/bootstrap/5.1.3/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/vendors/anchorjs/anchor.min.js') }}"></script>
	<script src="{{ asset('public/vendors/is/is.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/theme390.js') }}"></script>
</body>

</html>