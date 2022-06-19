<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="author" content="{{ config('app.manage_by', 'ĐHAG') }}" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	@yield('meta')
	<title>@yield('title', 'Chuyên mục') - {{ config('app.name', 'LCMS') }}</title>
	<link rel="shortcut icon" href="{{ asset('public/favicon.ico') }}" />
	<link rel="stylesheet" href="{{ asset('public/frontend/css/plugins.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/frontend/css/style.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/frontend/css/color-variations/blue.css') }}" media="screen" />
	@yield('css')
</head>
<body class="boxed background-secondary">
	<div class="body-inner">
		<header id="header" class="header-disable-fixed">
			<div class="header-inner">
				<div class="container">
					<div id="logo">
						<a href="{{ route('home') }}">
							<span class="logo-default d-lg-none d-xl-block"><img src="{{ asset('public/frontend/images/logo.png') }}" style="max-height:50px;" /></span>
							<span class="logo-default d-none d-lg-block d-xl-none"><img src="{{ asset('public/frontend/images/logo-only.png') }}" style="max-height:50px;" /></span>
							<span class="logo-dark"><img src="{{ asset('public/frontend/images/logo.png') }}" style="max-height:50px;" /></span>
						</a>
					</div>
					<div id="search">
						<a id="btn-search-close" class="btn-search-close" aria-label="Đóng"><i class="icon-x"></i></a>
						<form class="search-form" action="https://www.google.com.vn/search" method="get">
							<input type="hidden" name="hl" id="hl" value="vi" />
							<input type="hidden" name="as_sitesearch" id="as_sitesearch" value="fit.agu.edu.vn" />
							<input class="form-control" name="as_q" id="as_q" type="search" placeholder="Bạn muốn tìm gì?" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
							<span class="text-muted">Nhấn "Enter" để tìm kiếm hoặc "ESC" để đóng cửa sổ.</span>
						</form>
					</div>
					<div class="header-extras">
						<ul>
							<li><a id="btn-search" href="#tim-kiem"><i class="icon-search"></i></a></li>
						</ul>
					</div>
					<div id="mainMenu-trigger"><a class="lines-button x"><span class="lines"></span></a></div>
					<div id="mainMenu">
						<div class="container">
							<nav>
								<ul>
									<li><a href="#gioi-thieu"><i class="fal fa-globe-asia"></i>Giới thiệu</a></li>
									<li><a href="#thong-bao"><i class="fal fa-bullhorn"></i>Thông báo kê khai</a></li>
									<li><a href="{{ route('login') }}"><i class="fal fa-sign-in-alt"></i>Đăng nhập hệ thống</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</header>
		
		@yield('content')
		
		<footer id="footer">
			<div class="copyright-content">
				<div class="container">
					<div class="copyright-text text-center text-uppercase">&copy; {{ @date("Y") }} {{ config('app.manage_by', 'ĐHAG') }}.</div>
				</div>
			</div>
		</footer>
	</div>
	
	<a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
	<script src="{{ asset('public/frontend/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/plugins.js') }}"></script>
	<script src="{{ asset('public/frontend/js/functions.js') }}"></script>
	@yield('javascript')
</body>
</html>