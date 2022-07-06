@extends('layouts.dashboard')

@section('pagetitle')
Thông tin giảng viên
@endsection

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card"
            style="background-image:url('{{ asset('public/assets/img/illustrations/corner-4.png') }}');"></div>
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <nav style="--falcon-breadcrumb-divider:'»';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route(Auth::user()->privilege.'.home') }}"><i class="fad fa-home-alt"></i></a></li>
                            <li class="breadcrumb-item"><a >Giảng viên</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thông tin giảng viên</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-0">
        <div class="card-header bg-light">
            <h5 class="mb-0">Thông tin giảng viên</h5>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="fw-bold text-primary"><i class="fal fa-check-circle"></i> {{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <span class="fw-bold text-primary"><i class="fal fa-exclamation-triangle"></i>
                        {{ session('warning') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('user.hoso') }}" method="post" class="needs-validation">
                @csrf
                <div class="container ">
					<div class="row">	
						<div class="col-12 mb-3  d-flex justify-content-center align-items-center">
							<label class="form-label" for="MaGiangVien_edit" style="font-size: 18px"> Mã giảng viên: {{ $giangvien->MaGiangVien }} </label>
						</div>
					</div>
					<div class="row pt-1">
						<div class="col-6 mb-3">
							<label class="form-label" for="HoVaTen_edit"> Họ Tên </label>
							<input type="text" class="form-control @error('HoVaTen_edit') is-invalid @enderror" id="HoVaTen_edit" name="HoVaTen_edit" value="{{$giangvien->HoVaTen}}" required />
							@error('HoVaTen_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						  {{-- <p class="text-muted">{{$giangvien->HoVaTen}}</p> --}}
						</div>
						<div class="col-6 mb-3">
							<label class="form-label" for="Email_edit"> Email </label>
							<input type="email" class="form-control @error('Email_edit') is-invalid @enderror" id="Email_edit" name="Email_edit" value="{{$giangvien->Email}}" required />
							@error('Email_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror 
						  {{-- <p class="text-muted">{{$giangvien->Email}}</p> --}}
						</div>
					</div>
					<div class="row pt-1">
						<div class="col-6 mb-3">
						  	<label class="form-label" for="MaNgach_edit"> Ngạch </label>
							<select class="form-select @error('MaNgach_edit') is-invalid @enderror" id="MaNgach_edit" name="MaNgach_edit" required>
								<option value="">-- Chọn ngạch --</option>
                                @foreach($ngach as $value)
								<option value="{{$value->MaNgach}}" {{ $giangvien->MaNgach== $value->MaNgach ? "selected" : "" }}>{{$value->MaNgach}}</option>
								@endforeach
							</select>
							@error('MaNgach_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						  {{-- <p class="text-muted">{{$giangvien->HoVaTen}}</p> --}}
						</div>
						<div class="col-6 mb-3">
						  	<label class="form-label" for="MaBoMon_edit"> Bộ môn </label>
							<select class="form-select @error('MaBoMon_edit') is-invalid @enderror" id="MaBoMon_edit" name="MaBoMon_edit" required>
								<option value="">-- Chọn bộ môn --</option>
                                @foreach($bomon as $value)
								<option value="{{$value->MaBoMon}}" {{ $giangvien->MaBoMon== $value->MaBoMon ? "selected" : "" }}>{{$value->TenBoMon}}</option>
								@endforeach
							</select>
							@error('MaBoMon_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						  {{-- <p class="text-muted">{{$giangvien->Email}}</p> --}}
						</div>
					</div>
					<div class="row ">
						<div class="col-12 mb-3 d-flex justify-content-center align-items-center">
							<button type="submit" class="btn btn-primary"><i class="fal fa-edit"></i> Cập nhật thông tin</button>
						</div>
					</div>									
                </div>
            </form>
        </div>
    </div>
@endsection
