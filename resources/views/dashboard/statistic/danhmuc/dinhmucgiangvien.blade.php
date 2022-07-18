@extends('layouts.dashboard')

@section('pagetitle')
	Định mức của giảng viên
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
							<li class="breadcrumb-item"><a href="{{ route('statistic.home') }}">Cán bộ thống kê</a></li>
							<li class="breadcrumb-item active" aria-current="page">Định mức của giảng viên</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card mb-0">
		<div class="card-header bg-light">
			<h5 class="mb-0">Định mức của giảng viên</h5>
		</div>
		<div class="card-body pb-0">
			<form action="{{ route('statistic.dinhmucgiangvien.khoa') }}" method="POST">
				@csrf
				<div class="row g-3 align-items-center mb-3">
					<div class="col-auto">
						<label class="col-form-label" for="MaKhoa"> Khoa </label>
					</div>
					<div class="col-auto">
						<select class="form-select  @error('MaKhoa') is-invalid @enderror" id="MaKhoa" name="MaKhoa" required>
							<option value="">-- Chọn Khoa --</option>
							@foreach($khoa as $value)
							<option value="{{$value->MaKhoa}}" {{$makhoa==$value->MaKhoa?'selected':''}}>{{$value->TenKhoa}}</option>
							@endforeach
						</select>
						@error('MaKhoa')
							<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
						@enderror
					</div>
					<div class="col-auto">
						<button type="submit" class="btn btn-danger">Xác nhận</button>
					</div>
					
				</div>	
			</form>
			<form action="{{ route('statistic.dinhmucgiangvien.bomon') }}" method="POST">
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
			{{-- <p><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModalThem"><i class="fal fa-plus"></i> Thêm</button></p> --}}
			<div class="table-responsive scrollbar">
				<table id="DataList" class="table table-bordered table-hover table-sm overflow-hidden">
					<thead>
						<tr>
							<th class="text-nowrap" width="5%">#</th>
                            <th class="text-nowrap" width="15%">Mã giảng viên</th>
							<th class="text-nowrap" width="15%">Họ và tên</th>
							<th class="text-nowrap" width="20%">Định mức giảng dạy</th>
                            <th class="text-nowrap" width="20%" title="Định mức nghiên cứu khoa học">Định mức NCKH</th>
                            <th class="text-nowrap" width="15%">Năm học</th>
						</tr>
					</thead>
					<tbody>
						@foreach($dinhmucgiangvien as $value)
							<tr>
								<td class="align-middle">{{ $loop->iteration }}</td>
								<td class="align-middle">{{ $value->MaGiangVien}}</td>
								<td class="align-middle">{{ $value->GiangVien->HoVaTen }}</td>
								<td class="align-middle">{{ $value->DinhMucGiangDay }}</td>
								<td class="align-middle">{{ $value->DinhMucNCKH }}</td>
								<td class="align-middle">{{ $value->NamHoc }}</td>						
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="mt-1">
				{{ $dinhmucgiangvien->links() }}
			</div>
		</div>
	</div>
@endsection
	
@section('javascript')
	<script>
		function getCapNhat(ID, MaGiangVien, TongDinhMuc, NamHoc) {
			$('#id_edit').val(ID);
            $('#MaGiangVien_edit').val(MaGiangVien);
            $('#TongDinhMuc_edit').val(TongDinhMuc);
			$('#NamHoc_edit').val(NamHoc);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		@if($errors->has('ID') || $errors->has('MaGiangVien')|| $errors->has('TongDinhMuc')|| $errors->has('NamHoc'))
			var myModalThem = new bootstrap.Modal(document.getElementById('myModalThem'));
			myModalThem.show();
		@endif
		
		@if($errors->has('ID_edit') || $errors->has('MaGiangVien_edit')|| $errors->has('TongDinhMuc_edit')|| $errors->has('NamHoc_edit'))
			var myModalEdit = new bootstrap.Modal(document.getElementById('myModalEdit'));
			myModalEdit.show();
		@endif
	</script>
@endsection