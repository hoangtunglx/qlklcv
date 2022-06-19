@extends('layouts.auth')

@section('pagetitle')
	Đăng nhập
@endsection

@section('content')
	<div class="row flex-center min-vh-100 py-5">
		<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<a class="d-flex flex-center mb-3" href="{{ route('home') }}">
				<img src="{{ asset('public/assets/img/logos/agu.png') }}" width="58" />
			</a>
			<div class="card">
				<div class="card-body p-3">
					<h4 class="text-center mb-2">Đăng nhập</h4>
					<form method="post" action="{{ route('login') }}" id="login-form" class="needs-validation" novalidate>
						@csrf
						@if(session('warning'))
							<div class="alert alert-danger border-1 d-flex align-items-center" role="alert">
								<div class="bg-danger me-2 icon-item"><span class="fas fa-times-circle text-white fs-3"></span></div>
								<p class="mb-0 flex-1">{{ session('warning') }}</p>
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
						<div class="mb-3">
							<label class="form-label" for="email">Tài khoản</label>
							<input class="form-control{{ ($errors->has('email') || $errors->has('username')) ? ' is-invalid' : '' }}" type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Email hoặc Tên đăng nhập" required />
							@if($errors->has('email') || $errors->has('username'))
								<div class="invalid-feedback"><strong>{{ empty($errors->first('email')) ? $errors->first('username') : $errors->first('email') }}</strong></div>
							@endif
						</div>
						<div class="mb-3">
							<div class="d-flex justify-content-between">
								<label class="form-label" for="card-password">Mật khẩu</label>
								@if(Route::has('password.request'))
									<a class="fs--1" href="{{ route('password.request') }}">Quên mật khẩu?</a>
								@endif
							</div>
							<input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" placeholder="Mật khẩu" required />
							@error('password')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<div class="form-check mb-0">
								<input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
								<label class="form-check-label" for="remember">Duy trì đăng nhập</label>
							</div>
						</div>
						<div class="mb-3">
							<button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit"><i class="fal fa-sign-in-alt"></i> Đăng nhập</button>
						</div>
					</form>
					<div class="position-relative mt-4">
						<hr class="bg-300" />
						<div class="divider-content-center">hoặc đăng nhập với</div>
					</div>
					<div class="row mt-2">
						<div class="col-12">
							<a class="btn btn-outline-google-plus btn-sm d-block w-100" href="{{ route('google.login') }}">
								<span class="fab fa-google-plus-g me-2" data-fa-transform="grow-8"></span> AGU Email (Google Workspace)
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection