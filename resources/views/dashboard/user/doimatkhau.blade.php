@extends('layouts.dashboard')

@section('pagetitle')
	Đổi mật khẩu
@endsection

@section('content')
	<div class="card mb-3">
		<div class="bg-holder d-none d-lg-block bg-card" style="background-image:url('{{ asset('public/assets/img/illustrations/corner-4.png') }}');"></div>
		<div class="card-body position-relative">
			<div class="row">
				<div class="col-lg-8">
					<nav style="--falcon-breadcrumb-divider:'»';" aria-label="breadcrumb">
						<ol class="breadcrumb">
							{{-- <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}"><i class="fad fa-home-alt"></i></a></li> --}}
							{{-- <li class="breadcrumb-item"><a href="{{ route('dashboard.hosonhanvien.home') }}">Hồ sơ nhân viên</a></li> --}}
							<li class="breadcrumb-item active" aria-current="page">Đổi mật khẩu</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card mb-0">
		<div class="card-header bg-light">
			<h5 class="mb-0">Đổi mật khẩu</h5>
		</div>
		<div class="card-body">
			@if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="fw-bold text-primary"><i class="fal fa-check-circle"></i> {{ session('success') }}</span> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
				{{-- <div class="alert alert-success alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
					
				</div> --}}
			@endif
			@if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <span class="fw-bold text-primary"><i class="fal fa-exclamation-triangle"></i> {{ session('warning') }}</span> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
			@endif
			<form action="{{ route('user.doimatkhau') }}" method="post" class="needs-validation" novalidate>
				@csrf
				<div class="mb-3">
					<label class="form-label" for="old_password"><span class="badge bg-info">1</span> Mật khẩu cũ <span class="text-danger fw-bold">*</span></label>
					<input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" required />
					@error('old_password')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="mb-3">
					<label class="form-label" for="new_password"><span class="badge bg-info">2</span> Mật khẩu mới <span class="text-danger fw-bold">*</span></label>
					<input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required />
					@error('new_password')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="mb-3">
					<label class="form-label" for="new_password_confirmation"><span class="badge bg-info">3</span> Xác nhận mật khẩu mới <span class="text-danger fw-bold">*</span></label>
					<input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="new_password_confirmation" name="new_password_confirmation" required />
					@error('new_password_confirmation')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="mb-0">
					<button type="submit" class="btn btn-primary"><i class="fal fa-edit"></i> Đổi mật khẩu</button>
				</div>
			</form>
		</div>
	</div>
@endsection