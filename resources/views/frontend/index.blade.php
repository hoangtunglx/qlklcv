@extends('layouts.frontend')

@section('meta')
	<meta property="og:image" content="{{ asset('public/frontend/images/share.png') }}" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="150" />
	<meta property="og:image:height" content="150" />
	<meta property="og:title" content="Trang chủ" />
	<meta property="og:description" content="Trang chủ {{ config('app.name', 'LCMS') }}." />
	<meta name="description" content="Trang chủ {{ config('app.name', 'LCMS') }}." />
@endsection

@section('title', 'Trang chủ')

@section('content')
	<section id="section-article" class="p-t-30 p-b-30">
		<div class="container">
			<div class="heading-text heading-section text-center heading-line">
				<h4>THÔNG BÁO KÊ KHAI</h4>
			</div>
			<div class="grid-articles-customize grid-articles-customize-space grid-articles-customize-v2">
				@foreach($baiviet ?? [] as $value)
					<article class="post-entry">
						<a href="{{ route('baiviet.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->TieuDeKhongDau . '-' . $value->ID . '.html']) }}" class="post-image"><img src="{{ $cms_baiviet_first_file[$value->ID] }}" /></a>
						<div class="post-entry-overlay">
							<div class="post-entry-meta">
								<div class="post-entry-meta-category">
									<span class="badge badge-primary"><a href="{{ route('baiviet.chude', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau]) }}">{{ $value->CMS_ChuDe->TenChuDe }}</a></span>
								</div>
								<div class="post-entry-meta-title">
									<h2><a href="{{ route('baiviet.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->TieuDeKhongDau . '-' . $value->ID . '.html']) }}">{{ $value->TieuDe }}</a></h2>
								</div>
								<span class="post-date"><i class="fal fa-calendar-alt"></i>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y') }}</span>
								<span class="post-numviews"><i class="fal fa-eye"></i>{{ $value->LuotXem }} lượt xem</span>
							</div>
						</div>
					</article>
				@endforeach
			</div>
		</div>
	</section>
@endsection