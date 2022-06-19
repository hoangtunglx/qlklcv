@extends('layouts.frontend')

@section('meta')
	<meta property="og:image" content="{{ asset('public/frontend/images/share.png') }}" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="150" />
	<meta property="og:image:height" content="150" />
	<meta property="og:title" content="404 - Không tìm thấy trang" />
	<meta property="og:description" content="Trang chủ {{ config('app.name', 'LCMS') }}." />
	<meta name="description" content="Trang chủ {{ config('app.name', 'LCMS') }}." />
@endsection

@section('title', '404 - Không tìm thấy trang')

@section('content')
	<section class="m-t-0 m-b-0">
		<div class="container">
			<div class="row">
				<div class="col-xl-6">
					<div class="page-error-404 text-center">404</div>
				</div>
				<div class="col-xl-6">
					<div class="mt-lg-4 mt-xl-0">
						<h1 class="text-medium text-sm-center text-xl-left">Không tìm thấy trang!</h1>
						<p class="lead text-sm-center text-xl-left">Liên kết trang bị lỗi hoặc trang này không còn tồn tại trên hệ thống.</p>
						<div class="seperator m-t-20"></div>
						<div class="text-sm-center text-xl-left"><a href="{{ route('home') }}" class="btn"><i class="fal fa-home"></i> Về trang chủ</a></div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection