@extends('layouts.auth')

@section('pagetitle')
	Khôi phục mật khẩu
@endsection

@section('content')
	<div class="row flex-center min-vh-100 py-5">
		<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<a class="d-flex flex-center mb-3" href="{{ route('home') }}">
				<img src="{{ asset('public/assets/img/logos/agu.png') }}" width="58" />
			</a>
			<div class="card">
				<div class="card-body p-3">
					<h5 class="text-center">Khôi phục mật khẩu</h5>
					<form method="post" action="{{ route('password.update') }}" class="needs-validation mt-3" novalidate>
						@csrf
						<input type="hidden" name="token" value="{{ $token }}" />
						<div class="mb-3">
							<label class="form-label" for="email">Địa chỉ Email</label>
							<input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ $email ?? old('email') }}" required />	
							@error('email')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="password">Mật khẩu mới</label>
							<input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" required />
							@error('password')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="password-confirm">Xác nhận mật khẩu mới</label>
							<input class="form-control" type="password" id="password-confirm" name="password_confirmation" required />
							@error('password_confirmation')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-0">
							<button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit"><i class="fal fa-exchange-alt"></i> Đổi mật khẩu</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection