<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="author" content="AGChain Lab." />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>503 - Bảo trì hệ thống - {{ config('app.name', 'LCMS') }}</title>
	<link rel="shortcut icon" href="{{ asset('public/frontend/logo.png') }}" />
	<link rel="stylesheet" href="{{ asset('public/frontend/css/plugins.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/frontend/css/style.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/frontend/css/color-variations/red.css') }}" media="screen" />
</head>
<body>
	<div class="body-inner">
		<section class="fullscreen text-center">
			<div class="container container-fullscreen">
				<div class="text-middle text-center">
					<i class="fal fa-exclamation-triangle fa-5x" style="color: #ffd530;"></i>
					<h1 class="text-uppercase text-lg mt-3">BẢO TRÌ HỆ THỐNG</h1>
					<p class="lead">Hệ thống đang được nâng cấp & bảo trì! Xin vui lòng quay lại sau vài phút nữa.</p>
				</div>
			</div>
			<div class="p-progress-bar-container title-up small">
				<div class="p-progress-bar" data-percent="80" data-delay="100" data-type="%" style="background-color:#ffd530">
					<div class="progress-title">TIẾN ĐỘ THỰC HIỆN</div>
				</div>
			</div>
		</section>
	</div>
	
	<a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
	<script src="{{ asset('public/frontend/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/plugins.js') }}"></script>
	<script src="{{ asset('public/frontend/js/functions.js') }}"></script>
</body>
</html>