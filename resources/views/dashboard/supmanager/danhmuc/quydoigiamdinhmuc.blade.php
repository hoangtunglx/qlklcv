@extends('layouts.dashboard')

@section('pagetitle')
	Quy đổi giảm định mức
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
							<li class="breadcrumb-item active" aria-current="page">Quy đổi giảm định mức</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card mb-0">
		<div class="card-header bg-light">
			<h5 class="mb-0">Quy đổi giảm định mức</h5>
		</div>
		<div class="card-body pb-0">
			<p>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModalThem"><i class="fal fa-plus"></i> Thêm</button>
				<a href="#nhap" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal"><i class="fal fa-upload"></i> Nhập từ Excel</a>
				<a href="{{ route('supmanager.quydoigiamdinhmuc.xuat') }}" class="btn btn-success"><i class="fal fa-download"></i> Xuất ra Excel</a>
			</p>
			<div class="table-responsive scrollbar">
				<table id="DataList" class="table table-bordered table-hover table-sm overflow-hidden">
					<thead>
						<tr>
							{{-- <th class="text-nowrap" width="5%">#</th> --}}
							<th class="text-nowrap" width="15%">ID</th>
							<th class="text-nowrap" width="40%">Hoạt động</th>
                            <th class="text-nowrap" width="15%">Phần trăm định mức</th>
                            <th class="text-nowrap" width="15%">Năm học</th>
							<th class="text-nowrap" width="5%">Sửa</th>
							<th class="text-nowrap" width="5%">Xóa</th>
						</tr>
					</thead>
					<tbody>
						{{-- @foreach($quydoigiamdinhmuc as $value) --}}
						@if($quydoigiamdinhmuc)
							<tr>
								{{-- <td class="align-middle">{{ $loop->iteration }}</td> --}}
								<td class="align-middle">{{ $quydoigiamdinhmuc->ID }}</td>
								<td class="align-middle">{{ $quydoigiamdinhmuc->HoatDong }}</td>
                                <td class="align-middle">{{ $quydoigiamdinhmuc->PhanTramDinhMuc }}</td>
                                <td class="align-middle">{{ $quydoigiamdinhmuc->NamHoc }}</td>
								<td class="align-middle text-center"><a href="#sua" data-bs-toggle="modal" data-bs-target="#myModalEdit" onclick="getCapNhat('{{ $quydoigiamdinhmuc->ID }}', '{{ $quydoigiamdinhmuc->HoatDong }}', '{{ $quydoigiamdinhmuc->PhanTramDinhMuc }}', '{{ $quydoigiamdinhmuc->NamHoc }}'); return false;"><i class="fal fa-edit"></i></a></td>
								<td class="align-middle text-center pe-1"><a href="#xoa" data-bs-toggle="modal" data-bs-target="#myModalDelete" onclick="getXoa('{{ $quydoigiamdinhmuc->ID }}'); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
							</tr>
						@endif
						{{-- @endforeach --}}
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<form action="{{ route('supmanager.quydoigiamdinhmuc.them') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<div class="modal fade" id="myModalThem" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm quy đổi giảm định mức</h5>
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
							<label class="form-label" for="PhanTramDinhMuc"><span class="badge bg-info">3</span> Phần trăm định mức<span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('PhanTramDinhMuc') is-invalid @enderror" id="PhanTramDinhMuc" name="PhanTramDinhMuc" value="{{ old('PhanTramDinhMuc') }}" required />
							@error('PhanTramDinhMuc')
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
	<form action="{{ route('supmanager.quydoigiamdinhmuc.sua') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="id_old" name="id_old" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật thông tin quy đổi giảm định mức </h5>
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
							<label class="form-label" for="PhanTramDinhMuc_edit"><span class="badge bg-info">3</span> Phần trăm định mức <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('PhanTramDinhMuc_edit') is-invalid @enderror" id="PhanTramDinhMuc_edit" name="PhanTramDinhMuc_edit" value="{{ old('PhanTramDinhMuc_edit') }}" required />
							@error('PhanTramDinhMuc_edit')
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
	<form action="{{ route('supmanager.quydoigiamdinhmuc.xoa') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete"/>
		<div class="modal fade" id="myModalDelete" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa quy đổi phần trăm định mức</h5>
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
	<form action="{{ route('supmanager.quydoigiamdinhmuc.nhap') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
		@csrf
		<div class="modal fade" id="importModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="importModalLabel">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="importModalLabel">Nhập từ Excel</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-0">
							<label class="form-label" for="file_excel"><span class="badge bg-info">1</span> Chọn tập tin Excel <span class="text-danger fw-bold">*</span></label>
							<input type="file" class="form-control" id="file_excel" name="file_excel" required />
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fal fa-times"></i> Hủy bỏ</button>
						<button type="submit" class="btn btn-danger"><i class="fal fa-upload"></i> Nhập dữ liệu</button>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection
	
@section('javascript')
	<script>
		function getCapNhat(ID, HoatDong, PhanTramDinhMuc, NamHoc) {
			$('#id_old').val(ID);
			$('#ID_edit').val(ID);
			$('#HoatDong_edit').val(HoatDong);
			$('#PhanTramDinhMuc_edit').val(PhanTramDinhMuc);
			$('#NamHoc_edit').val(NamHoc);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		@if($errors->has('ID') || $errors->has('HoatDong')|| $errors->has('PhanTramDinhMuc')|| $errors->has('NamHoc'))
			var myModalThem = new bootstrap.Modal(document.getElementById('myModalThem'));
			myModalThem.show();
		@endif
		
		@if($errors->has('ID_edit') || $errors->has('HoatDong_edit')|| $errors->has('PhanTramDinhMuc_edit')|| $errors->has('NamHoc_edit'))
			var myModalEdit = new bootstrap.Modal(document.getElementById('myModalEdit'));
			myModalEdit.show();
		@endif
	</script>
@endsection