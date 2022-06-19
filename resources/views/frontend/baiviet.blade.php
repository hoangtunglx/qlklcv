@extends('layouts.frontend')

@section('meta')
	<meta property="og:image" content="{{ asset('public/frontend/images/share.png') }}" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="150" />
	<meta property="og:image:height" content="150" />
	<meta property="og:title" content="{{ $session_title ?? $cms_chude->TenChuDe }}" />
	<meta property="og:description" content="Nhấn vào để xem các bài viết của {{ config('app.name', 'LCMS') }}." />
	<meta name="description" content="Nhấn vào để xem các bài viết của {{ config('app.name', 'LCMS') }}." />
@endsection

@section('title', $session_title ?? $cms_chude->TenChuDe)

@section('content')
	<section id="page-title" class="page-title-left p-t-10 p-b-10">
		<div class="container">
			<div class="breadcrumb">
				<ul>
					<li><a href="{{ route('home') }}"><i class="fal fa-home"></i> Trang chủ</a></li>
					<li class="active"><a href="{{ route('baiviet') }}"><i class="fal fa-newspaper"></i> Bài viết</a></li>
				</ul>
			</div>
			<div class="page-title">
				<h1>{{ $session_title ?? $cms_chude->TenChuDe }}</h1>
			</div>
		</div>
	</section>
	
	<section id="page-content" class="sidebar-right p-t-30 p-b-30">
		<div class="container">
			<div class="row">
				<div class="content col-lg-9">
					<div id="blog" class="grid-layout post-thumbnails post-1-columns m-b-10" data-item="post-item">
						@foreach($cms_baiviet as $value)
							<div class="post-item">
								<div class="post-item-wrap">
									<div class="post-image">
										<a href="{{ route('baiviet.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->TieuDeKhongDau . '-' . $value->ID . '.html']) }}"><img src="{{ $cms_baiviet_first_file[$value->ID] }}" /></a>
										<span class="post-meta-category"><a href="{{ route('baiviet.chude', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau]) }}">{{ $value->CMS_ChuDe->TenChuDe }}</a></span>
									</div>
									<div class="post-item-description">
										<span class="post-meta-date"><i class="fal fa-calendar-alt"></i>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y') }}</span>
										<span class="post-meta-comments"><i class="fal fa-eye"></i>{{ $value->LuotXem }} lượt xem</span>
										<h2 class="text-justify"><a href="{{ route('baiviet.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->TieuDeKhongDau . '-' . $value->ID . '.html']) }}">{{ $value->TieuDe }}</a></h2>
										<a href="{{ route('baiviet.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->TieuDeKhongDau . '-' . $value->ID . '.html']) }}" class="item-link">Xem tiếp <i class="fal fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
						@endforeach
					</div>
					<div id="pagination" class="d-flex justify-content-center">
						{{ $cms_baiviet->onEachSide(2)->links() }}
					</div>
				</div>
				<div class="sidebar sticky-sidebar col-lg-3">
					<div class="widget widget-tags">
						<h4 class="widget-title">Chuyên mục</h4>
						<div class="tags">
							@foreach($cms_chude_thongke as $value)
								<a href="{{ route('baiviet.chude', ['chuDe' => $value->TenChuDeKhongDau]) }}"><i class="fal fa-tag"></i> {{ $value->TenChuDe }} </a>
							@endforeach
						</div>
					</div>
					<div class="widget">
						<h4 class="widget-title">Xem nhiều nhất</h4>
						<div class="post-thumbnail-list">
							@foreach($cms_baiviet_xnn as $value)
								<div class="post-thumbnail-entry">
									<img src="{{ $cms_baiviet_xnn_first_file[$value->ID] }}" />
									<div class="post-thumbnail-content">
										<a class="text-left" href="{{ route('baiviet.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->TieuDeKhongDau . '-' . $value->ID . '.html']) }}">{{ $value->TieuDe }}</a>
										<span class="post-date"><i class="fal fa-calendar-alt"></i> {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y') }}</span>
										<span class="post-category"><i class="fal fa-eye"></i> {{ $value->LuotXem }} lượt xem</span>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('javascript')
	<script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_ARTICLE') }}"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());
		gtag('config', '{{ env('GOOGLE_ANALYTICS_ARTICLE') }}', { cookie_domain: 'fit.agu.edu.vn', cookie_flags: 'SameSite=None;Secure' });
	</script>
@endsection