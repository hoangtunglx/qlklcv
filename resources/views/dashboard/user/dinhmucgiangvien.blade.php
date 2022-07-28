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
							<li class="breadcrumb-item"><a href="{{ route(Auth::user()->privilege.'.home') }}">Giảng viên</a></li>
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
			<p><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModalThem"><i class="fal fa-plus"></i> Thêm</button></p>
			<div class="table-responsive scrollbar">
				<table id="DataList" class="table table-bordered table-hover table-sm overflow-hidden">
					<thead>
						<tr>
							<th class="text-nowrap" width="20%">Định mức giảng dạy</th>
                            <th class="text-nowrap" width="20%" title="Định mức nghiên cứu khoa học">Định mức NCKH</th>
                            <th class="text-nowrap" width="20%">Năm học</th>
							<th class="text-nowrap" width="5%">Sửa</th>
							<th class="text-nowrap" width="5%">Xóa</th>
						</tr>
					</thead>
					<tbody>
						@if ($dinhmucgiangvien)
						<tr>
							<td class="align-middle">{{ $dinhmucgiangvien->DinhMucGiangDay }}</td>
							<td class="align-middle">{{ $dinhmucgiangvien->DinhMucNCKH }}</td>
							<td class="align-middle">{{ $dinhmucgiangvien->NamHoc }}</td>
							<td class="align-middle text-center"><a href="#sua" data-bs-toggle="modal" data-bs-target="#myModalEdit" onclick="getCapNhat('{{ $dinhmucgiangvien->ID }}',{{$dinhmucgiangvien->DinhMucGiangDay}},{{$dinhmucgiangvien->DinhMucNCKH}},'{{$dinhmucgiangvien->NamHoc}}'); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="align-middle text-center pe-1"><a href="#xoa" data-bs-toggle="modal" data-bs-target="#myModalDelete" onclick="getXoa('{{ $dinhmucgiangvien->ID }}'); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
						@endif				
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
<form action="{{ route('user.dinhmucgiangvien.them') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<div class="modal fade" id="myModalThem" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm Định mức của giảng viên</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="DinhMucGiangDay"><span class="badge bg-info">1</span> Định mức giảng dạy<span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('DinhMucGiangDay') is-invalid @enderror" id="DinhMucGiangDay" name="DinhMucGiangDay" value="{{ old('DinhMucGiangDay') }}" required />
							@error('DinhMucGiangDay')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
						<div class="mb-3">
							<label class="form-label" for="DinhMucNCKH"><span class="badge bg-info">2</span> Định mức nghiên cứu khoa học <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('DinhMucNCKH') is-invalid @enderror" id="DinhMucNCKH" name="DinhMucNCKH" value="{{ old('DinhMucNCKH') }}" required />
							@error('DinhMucNCKH')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<form action="{{ route('user.dinhmucgiangvien.sua') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật thông tin Định mức của giảng viên</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="DinhMucGiangDay_edit"><span class="badge bg-info">1</span> Định mức giảng dạy <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('DinhMucGiangDay_edit') is-invalid @enderror" id="DinhMucGiangDay_edit" name="DinhMucGiangDay_edit" value="{{ old('DinhMucGiangDay_edit') }}" required />
							@error('DinhMucGiangDay_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
						<div class="mb-3">
							<label class="form-label" for="DinhMucNCKH_edit"><span class="badge bg-info">2</span> Định mức nghiên cứu khoa học  <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('DinhMucNCKH_edit') is-invalid @enderror" id="DinhMucNCKH_edit" name="DinhMucNCKH_edit" value="{{ old('DinhMucNCKH_edit') }}" required />
							@error('DinhMucNCKH_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>                       
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<form action="{{ route('user.dinhmucgiangvien.xoa') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete"/>
		<div class="modal fade" id="myModalDelete" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa định mức của giảng viên</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body fw-bold text-danger text-center">
						<p class="mt-0 mb-1"><i class="fad fa-question-circle fa-3x"></i></p>
						<p class="mt-1 mb-0">Xác nhận xóa? Hành động này không thể phục hồi.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fal fa-times"></i> Hủy bỏ</button>
						<button type="submit" class="btn btn-danger"><i class="fal fa-trash-alt"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection
	
@section('javascript')
	<script>
		function getCapNhat(ID, DinhMucGiangDay, DinhMucNCKH, NamHoc) {
			$('#ID_edit').val(ID);
            $('#DinhMucGiangDay_edit').val(DinhMucGiangDay);
            $('#DinhMucNCKH_edit').val(DinhMucNCKH);
			$('#NamHoc_edit').val(NamHoc);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		@if($errors->has('ID') || $errors->has('DinhMucGiangDay')|| $errors->has('DinhMucNCKH')|| $errors->has('NamHoc'))
			var myModalThem = new bootstrap.Modal(document.getElementById('myModalThem'));
			myModalThem.show();
		@endif
		
		@if($errors->has('ID_edit') || $errors->has('DinhMucGiangDay_edit')|| $errors->has('DinhMucNCKH_edit')|| $errors->has('NamHoc_edit'))
			var myModalEdit = new bootstrap.Modal(document.getElementById('myModalEdit'));
			myModalEdit.show();
		@endif
	</script>
@endsection