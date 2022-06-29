@extends('layouts.dashboard_error')

@section('pagetitle')
	403 - Cấm truy xuất
@endsection

@section('content')
	<div class="row flex-center min-vh-100 text-center">
		<div class="col-sm-10 col-md-8 col-lg-6 col-xxl-5">
			<a class="d-flex flex-center mb-3" href="{{ route('home') }}">
				<img src="{{ asset('public/assets/img/logos/agu.png') }}" width="58" />
			</a>
			<div class="card">
				<div class="card-body p-3 p-sm-5">
					<div class="fw-black lh-1 text-300 fs-error">403</div>
					<p class="lead mt-3 text-800 font-sans-serif fw-semi-bold">Cấm truy xuất!</p>
					<hr />
					<p>Bạn không đủ quyền để thao tác chức năng này!</p>
				</div>
			</div>
		</div>
	</div>
@endsection