@extends('layouts.dashboard')

@section('pagetitle')
	Bài viết
@endsection

@section('content')
	<div class="card mb-3">
		<div class="bg-holder d-none d-lg-block bg-card" style="background-image:url('{{ asset('public/assets/img/illustrations/corner-4.png') }}');"></div>
		<div class="card-body position-relative">
			<div class="row">
				<div class="col-lg-8">
					<nav style="--falcon-breadcrumb-divider:'»';" aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}"><i class="fad fa-home-alt"></i></a></li>
							<li class="breadcrumb-item active" aria-current="page">Bài viết</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card mb-0">
		<div class="card-header bg-light">
			<h5 class="mb-0">Bài viết</h5>
		</div>
		<div class="card-body fs--1 pb-0">
			<div class="row">
				<div class="col-sm-6 col-md-4 mb-3">
					<div class="d-flex position-relative align-items-center mb-2">
						<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/dsbaiviet.png') }}" width="50" />
						<div class="flex-1">
							<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('dashboard.baiviet.danhsach') }}">Bài viết đã đăng</a></h6>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 mb-3">
					<div class="d-flex position-relative align-items-center mb-2">
						<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/thembaiviet.png') }}" width="50" />
						<div class="flex-1">
							<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('dashboard.baiviet.them') }}">Đăng bài viết</a></h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection