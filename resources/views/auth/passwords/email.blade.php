@extends('layouts.auth')

@section('pagetitle')
	Quên mật khẩu
@endsection

@section('content')
	<div class="row flex-center min-vh-100 py-5 text-center">
		<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<a class="d-flex flex-center mb-3" href="{{ route('home') }}">
				<img src="{{ asset('public/assets/img/logos/agu.png') }}" width="58" />
			</a>
			<div class="card">
				<div class="card-body p-3">
					<h5 class="mb-0">Quên mật khẩu?</h5>
					<small>Xin vui lòng nhập vào địa chỉ Email đã dùng khi đăng ký tài khoản.</small>
					<form method="post" action="{{ route('password.email') }}" class="needs-validation mt-4" novalidate>
						@csrf
						@if(session('status'))
							<div class="alert alert-success border-1 d-flex align-items-center" role="alert">
								<div class="bg-success me-2 icon-item"><span class="fas fa-check-circle text-white fs-3"></span></div>
								<p class="mb-0 flex-1">{{ session('status') }}</p>
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
						<div class="mb-3">
							<input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Địa chỉ Email" required />
							@error('email')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit"><i class="fal fa-paper-plane"></i> Gởi liên kết khôi phục mật khẩu</button>
						</div>
					</form>
					<a class="fs--1 text-600" href="{{ route('login') }}"><span class="d-inline-block ms-1">&larr;</span> Về trang đăng nhập</a>
				</div>
			</div>
		</div>
	</div>
@endsection