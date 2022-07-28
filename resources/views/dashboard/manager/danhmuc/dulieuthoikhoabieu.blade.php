@extends('layouts.dashboard')

@section('pagetitle')
	Dữ liệu thời khóa biểu
@endsection

@section('content')
	<div class="card mb-3">
		<div class="bg-holder d-none d-lg-block bg-card" style="background-image:url('{{ asset('public/assets/img/illustrations/corner-4.png') }}');"></div>
		<div class="card-body position-relative">
			<div class="row">
				<div class="col-lg-8">
					<nav style="--falcon-breadcrumb-divider:'»';" aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a ><i class="fad fa-home-alt"></i></a></li>
							{{-- href="{{ route('dashboard.danhmuc.home') }}" --}}
							<li class="breadcrumb-item"><a href="{{ route('manager.home') }}">Bộ môn và khoa</a></li>
							<li class="breadcrumb-item active" aria-current="page">Dữ liệu thời khóa biểu</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card mb-0">
		<div class="card-header bg-light">
			<h5 class="mb-0">Dữ liệu thời khóa biểu</h5>
		</div>
		<div class="card-body pb-0">
			<form action="{{ route('manager.dulieuthoikhoabieu.bomon') }}" method="POST">
				@csrf
				<div class="row g-3 align-items-center mb-3">
					<div class="col-auto">
						<label class="col-form-label" for="MaBoMon"> Bộ môn </label>
					</div>
					<div class="col-auto">
						<select class="form-select  @error('MaBoMon') is-invalid @enderror" id="MaBoMon" name="MaBoMon" required>
							<option value="">-- Chọn Bộ môn --</option>
							@foreach($bomon as $value)
							<option value="{{$value->MaBoMon}}" {{$mabomon==$value->MaBoMon?'selected':''}}>{{$value->TenBoMon}}</option>
							@endforeach
						</select>
						@error('MaBoMon')
							<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
						@enderror
					</div>
					<div class="col-auto">
						<button type="submit" class="btn btn-danger">Xác nhận</button>
					</div>
					
				</div>	
			</form>
			<div class="table-responsive scrollbar">
				<table id="DataList" class="table table-bordered table-hover table-sm overflow-hidden">
					<thead>
						<tr>
							<th class="text-nowrap" width="5%">#</th>
							<th class="text-nowrap" width="10%">Mã CBGD</th>
							<th class="text-nowrap" width="10%">Mã HP</th>
                            <th class="text-nowrap" width="5%">Nhóm</th>
							<th class="text-nowrap" width="5%">Tổ TH</th></th>
                            <th class="text-nowrap" width="5%">Phòng</th>
							<th class="text-nowrap" width="5%">Sỉ số TKB</th></th>
                            <th class="text-nowrap" width="5%">Thứ</th>
							<th class="text-nowrap" width="10%">Tiết bắt đầu</th></th>
                            <th class="text-nowrap" width="5%">Số tiết</th>
							<th class="text-nowrap" width="5%">Tổng số tiết</th></th>
                            <th class="text-nowrap" width="10%">Lớp</th>
							<th class="text-nowrap" width="10%">Học kì</th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($dulieuthoikhoabieu as $value)
							<tr>
								<td class="align-middle">{{ $loop->iteration }}</td>
								<td class="align-middle">{{ $value->MaGiangVien }}</td>
								<td class="align-middle">{{ $value->MaHocPhan }}</td>
                                <td class="align-middle">{{ $value->Nhom }}</td>
								<td class="align-middle">{{ $value->ToThucHanh }}</td>
                                <td class="align-middle">{{ $value->Phong }}</td>
								<td class="align-middle">{{ $value->SiSoTKB }}</td>
                                <td class="align-middle">{{ $value->Thu }}</td>
								<td class="align-middle">{{ $value->TietBatDau }}</td>
                                <td class="align-middle">{{ $value->SoTiet }}</td>
								<td class="align-middle">{{ $value->TongSoTiet }}</td>
                                <td class="align-middle">{{ $value->Lop }}</td>
								<td class="align-middle">{{ $value->HocKy }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection