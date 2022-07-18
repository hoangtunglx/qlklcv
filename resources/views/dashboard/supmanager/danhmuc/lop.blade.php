@extends('layouts.dashboard')

@section('pagetitle')
	Lớp
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
							<li class="breadcrumb-item active" aria-current="page">Lớp</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card mb-0">
		<div class="card-header bg-light">
			<h5 class="mb-0">Lớp</h5>
		</div>
		<div class="card-body pb-0">
			<p>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModalThem"><i class="fal fa-plus"></i> Thêm</button>
				<a href="#nhap" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal"><i class="fal fa-upload"></i> Nhập từ Excel</a>
				<a href="{{route('supmanager.lop.xuat')}}" class="btn btn-success"><i class="fal fa-download"></i> Xuất ra Excel</a>
			</p>
			<div class="table-responsive scrollbar">
				<table id="DataList" class="table table-bordered table-hover table-sm overflow-hidden">
					<thead>
						<tr>
							<th class="text-nowrap" width="5%">#</th>
                            <th class="text-nowrap" width="20%">Mã lớp</th>
							<th class="text-nowrap" width="20%">Tên lớp</th>
							<th class="text-nowrap" width="20%">Sĩ số</th>
							<th class="text-nowrap" width="25%">Khoa</th>
							<th class="text-nowrap" width="5%">Sửa</th>
							<th class="text-nowrap" width="5%">Xóa</th>
						</tr>
					</thead>
					<tbody>
						@foreach($lop as $value)
							<tr>
								<td class="align-middle">{{ $loop->iteration }}</td>
								<td class="align-middle">{{ $value->MaLop}}</td>
								<td class="align-middle">{{ $value->TenLop }}</td>
								<td class="align-middle">{{ $value->SiSo }}</td>
                                <td class="align-middle">{{ $value->Khoa->TenKhoa}}</td>
								<td class="align-middle text-center"><a href="#sua" data-bs-toggle="modal" data-bs-target="#myModalEdit" onclick="getCapNhat('{{ $value->MaLop }}', '{{ $value->TenLop }}',{{$value->SiSo}},'{{$value->MaKhoa}}'); return false;"><i class="fal fa-edit"></i></a></td>
								<td class="align-middle text-center pe-1"><a href="#xoa" data-bs-toggle="modal" data-bs-target="#myModalDelete" onclick="getXoa('{{ $value->MaLop }}'); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="mt-1">
				{{ $lop->links() }}
			</div>
		</div>
	</div>
	<form action="{{ route('supmanager.lop.them') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<div class="modal fade" id="myModalThem" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm lớp</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="MaLop"><span class="badge bg-info">1</span> Mã lớp <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('MaLop') is-invalid @enderror" id="MaLop" name="MaLop" value="{{ old('MaLop') }}" required />
							@error('MaLop')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="TenLop"><span class="badge bg-info">2</span> Tên lớp <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('TenLop') is-invalid @enderror" id="TenLop" name="TenLop" value="{{ old('TenLop') }}" required />
							@error('TenLop')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="SiSo"><span class="badge bg-info">3</span> Sĩ số <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('SiSo') is-invalid @enderror" id="SiSo" name="SiSo" value="{{ old('SiSo') }}" required />
							@error('SiSo')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-0">
							<label class="form-label" for="MaKhoa"><span class="badge bg-info">4</span> Khoa <span class="text-danger fw-bold">*</span></label>
							<select class="form-select @error('MaKhoa') is-invalid @enderror" id="MaKhoa" name="MaKhoa" required>
								<option value="">-- Chọn Khoa --</option>
                                @foreach($khoa as $value)
								<option value="{{$value->MaKhoa}}" {{ old('MaKhoa') == $value->MaKhoa ? "selected" : "" }}>{{$value->TenKhoa}}</option>
								@endforeach
							</select>
							@error('MaKhoa')
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
	<form action="{{ route('supmanager.lop.sua') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="id_edit" name="id_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật thông tin lớp</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="MaLop_edit"><span class="badge bg-info">1</span> Mã lớp <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('MaLop_edit') is-invalid @enderror" id="MaLop_edit" name="MaLop_edit" value="{{ old('MaLop_edit') }}" required />
							@error('MaLop_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="TenLop_edit"><span class="badge bg-info">2</span> Tên lớp <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('TenLop_edit') is-invalid @enderror" id="TenLop_edit" name="TenLop_edit" value="{{ old('TenLop_edit') }}" required />
							@error('TenLop_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="SiSo_edit"><span class="badge bg-info">3</span> Sĩ số <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('SiSo_edit') is-invalid @enderror" id="SiSo_edit" name="SiSo_edit" value="{{ old('SiSo_edit') }}" required />
							@error('SiSo_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-0">
							<label class="form-label" for="MaKhoa_edit"><span class="badge bg-info">4</span> Khoa <span class="text-danger fw-bold">*</span></label>
							<select class="form-select @error('MaKhoa_edit') is-invalid @enderror" id="MaKhoa_edit" name="MaKhoa_edit" required>
								<option value="">-- Chọn Khoa --</option>
                                @foreach($khoa as $value)
								<option value="{{$value->MaKhoa}}" {{ old('MaKhoa_edit') == $value->MaKhoa ? "selected" : "" }}>{{$value->TenKhoa}}</option>
								@endforeach
							</select>
							@error('MaKhoa_edit')
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
	<form action="{{ route('supmanager.lop.xoa') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="MaLop_delete" name="MaLop_delete"/>
		<div class="modal fade" id="myModalDelete" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa lớp</h5>
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
	<form action="{{ route('supmanager.lop.nhap') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
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
		function getCapNhat(MaLop, TenLop,SiSo, MaKhoa) {
			$('#id_edit').val(MaLop);
            $('#MaLop_edit').val(MaLop);
            $('#TenLop_edit').val(TenLop);
			$('#SiSo_edit').val(SiSo);
			$('#MaKhoa_edit').val(MaKhoa);
		}
		
		function getXoa(id) {
			$('#MaLop_delete').val(id);
		}
		
		@if($errors->has('MaLop') || $errors->has('TenLop')|| $errors->has('SiSo')|| $errors->has('MaKhoa'))
			var myModalThem = new bootstrap.Modal(document.getElementById('myModalThem'));
			myModalThem.show();
		@endif
		
		@if($errors->has('MaLop_edit') || $errors->has('TenLop_edit')|| $errors->has('SiSo_edit')|| $errors->has('MaKhoa_edit'))
			var myModalEdit = new bootstrap.Modal(document.getElementById('myModalEdit'));
			myModalEdit.show();
		@endif
	</script>
@endsection