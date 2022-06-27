@extends('layouts.dashboard')

@section('pagetitle')
	Quy đổi hệ số
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
							<li class="breadcrumb-item"><a href="{{ route('supmanager.home') }}">Phòng đào tạo</a></li>
							<li class="breadcrumb-item active" aria-current="page">Quy đổi hệ số</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card mb-0">
		<div class="card-header bg-light">
			<h5 class="mb-0">Quy đổi hệ số</h5>
		</div>
		<div class="card-body pb-0">
			<p><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModalThem"><i class="fal fa-plus"></i> Thêm</button></p>
			<div class="table-responsive scrollbar">
				<table id="DataList" class="table table-bordered table-hover table-sm overflow-hidden">
					<thead>
						<tr>
							<th class="text-nowrap" width="5%">#</th>
							<th class="text-nowrap" width="15%">ID</th>
							<th class="text-nowrap" width="40%">Hoạt động</th>
                            <th class="text-nowrap" width="15%">Hệ số</th>
                            <th class="text-nowrap" width="15%">Năm học</th>
							<th class="text-nowrap" width="5%">Sửa</th>
							<th class="text-nowrap" width="5%">Xóa</th>
						</tr>
					</thead>
					<tbody>
						@foreach($quydoiheso as $value)
							<tr>
								<td class="align-middle">{{ $loop->iteration }}</td>
								<td class="align-middle">{{ $value->ID }}</td>
								<td class="align-middle">{{ $value->HoatDong }}</td>
                                <td class="align-middle">{{ $value->HeSo }}</td>
                                <td class="align-middle">{{ $value->NamHoc }}</td>
								<td class="align-middle text-center"><a href="#sua" data-bs-toggle="modal" data-bs-target="#myModalEdit" onclick="getCapNhat('{{ $value->ID }}', '{{ $value->HoatDong }}', '{{ $value->HeSo }}', '{{ $value->NamHoc }}'); return false;"><i class="fal fa-edit"></i></a></td>
								<td class="align-middle text-center pe-1"><a href="#xoa" data-bs-toggle="modal" data-bs-target="#myModalDelete" onclick="getXoa('{{ $value->ID }}'); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<form action="{{ route('supmanager.quydoiheso.them') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<div class="modal fade" id="myModalThem" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm quy đổi hệ số</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="ID"><span class="badge bg-info">1</span> ID <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('ID') is-invalid @enderror" id="ID" name="ID" value="{{ old('ID') }}" required />
							@error('ID')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="HoatDong"><span class="badge bg-info">2</span> Hoạt động <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('HoatDong') is-invalid @enderror" id="HoatDong" name="HoatDong" value="{{ old('HoatDong') }}" required />
							@error('HoatDong')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="HeSo"><span class="badge bg-info">3</span> Hệ số <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('HeSo') is-invalid @enderror" id="HeSo" name="HeSo" value="{{ old('HeSo') }}" required />
							@error('HeSo')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
						<div class="mb-3">
							<label class="form-label" for="NamHoc"><span class="badge bg-info">4</span> Năm học <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('NamHoc') is-invalid @enderror" id="NamHoc" name="NamHoc" value="{{ old('NamHoc') }}" required />
							@error('NamHoc')
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
	<form action="{{ route('supmanager.quydoiheso.sua') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="id_old" name="id_old" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật thông tin quy đổi hệ số</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="ID_edit"><span class="badge bg-info">1</span> ID <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('ID_edit') is-invalid @enderror" id="ID_edit" name="ID_edit" value="{{ old('ID_edit') }}" required />
							@error('ID_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="HoatDong_edit"><span class="badge bg-info">2</span> Hoạt động <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('HoatDong_edit') is-invalid @enderror" id="HoatDong_edit" name="HoatDong_edit" value="{{ old('HoatDong_edit') }}" required />
							@error('HoatDong_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="HeSo_edit"><span class="badge bg-info">3</span> Hệ số <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('HeSo_edit') is-invalid @enderror" id="HeSo_edit" name="HeSo_edit" value="{{ old('HeSo_edit') }}" required />
							@error('HeSo_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="NamHoc_edit"><span class="badge bg-info">4</span> Năm học <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('NamHoc_edit') is-invalid @enderror" id="NamHoc_edit" name="NamHoc_edit" value="{{ old('NamHoc_edit') }}" required />
							@error('NamHoc_edit')
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
	<form action="{{ route('supmanager.quydoiheso.xoa') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete"/>
		<div class="modal fade" id="myModalDelete" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa quy đổi hệ số</h5>
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
		function getCapNhat(ID, HoatDong, HeSo, NamHoc) {
			$('#id_old').val(ID);
			$('#ID_edit').val(ID);
			$('#HoatDong_edit').val(HoatDong);
			$('#HeSo_edit').val(HeSo);
			$('#NamHoc_edit').val(NamHoc);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		@if($errors->has('ID') || $errors->has('HoatDong')|| $errors->has('HeSo')|| $errors->has('NamHoc'))
			var myModalThem = new bootstrap.Modal(document.getElementById('myModalThem'));
			myModalThem.show();
		@endif
		
		@if($errors->has('ID_edit') || $errors->has('HoatDong_edit')|| $errors->has('HeSo_edit')|| $errors->has('NamHoc_edit'))
			var myModalEdit = new bootstrap.Modal(document.getElementById('myModalEdit'));
			myModalEdit.show();
		@endif
	</script>
@endsection