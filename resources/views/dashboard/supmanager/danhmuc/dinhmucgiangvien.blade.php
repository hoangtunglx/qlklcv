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
							<li class="breadcrumb-item"><a href="{{ route('supmanager.home') }}">Phòng đào tạo</a></li>
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
			<form action="{{ route('supmanager.dinhmucgiangvien.khoa') }}" method="POST">
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
			<form action="{{ route('supmanager.dinhmucgiangvien.bomon') }}" method="POST">
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
							{{-- <th class="text-nowrap" width="5%">Sửa</th>
							<th class="text-nowrap" width="5%">Xóa</th> --}}
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
		</div>
	</div>
	{{-- <form action="{{ route('supmanager.dinhmucgiangvien.them') }}" method="post" class="needs-validation" novalidate>
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
							<label class="form-label" for="MaGiangVien"><span class="badge bg-info">1</span> Bộ môn <span class="text-danger fw-bold">*</span></label>
							<select class="form-select @error('MaGiangVien') is-invalid @enderror" id="MaGiangVien" name="MaGiangVien" required>
								<option value="">-- Chọn bộ môn --</option>
                                @foreach($bomon as $value)
								<option value="{{$value->MaGiangVien}}" {{ old('MaGiangVien') == $value->MaGiangVien ? "selected" : "" }}>{{$value->MaGiangVien}}</option>
								@endforeach
							</select>
							@error('MaGiangVien')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
						<div class="mb-3">
							<label class="form-label" for="TongDinhMuc"><span class="badge bg-info">2</span> Tổng định mức <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('TongDinhMuc') is-invalid @enderror" id="TongDinhMuc" name="TongDinhMuc" value="{{ old('TongDinhMuc') }}" required />
							@error('TongDinhMuc')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="NamHoc"><span class="badge bg-info">3</span> Năm học <span class="text-danger fw-bold">*</span></label>
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
	<form action="{{ route('supmanager.dinhmucgiangvien.sua') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="id_edit" name="id_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật thông tin Định mức của giảng viên</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="MaGiangVien_edit"><span class="badge bg-info">1</span> Giảng viên <span class="text-danger fw-bold">*</span></label>
							<select class="form-select @error('MaGiangVien_edit') is-invalid @enderror" id="MaGiangVien_edit" name="MaGiangVien_edit" required>
								<option value="">-- Chọn giảng viên --</option>
                                @foreach($giangvien as $value)
								<option value="{{$value->MaGiangVien}}" {{ old('MaGiangVien') == $value->MaGiangVien ? "selected" : "" }}>{{$value->HoVaTen}}</option>
								@endforeach
							</select>
							@error('MaGiangVien_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
						<div class="mb-3">
							<label class="form-label" for="TongDinhMuc_edit"><span class="badge bg-info">2</span> Định mức giảng dạy <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('TongDinhMuc_edit') is-invalid @enderror" id="TongDinhMuc_edit" name="TongDinhMuc_edit" value="{{ old('TongDinhMuc_edit') }}" required />
							@error('TongDinhMuc_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="DinhMucNCKH_edit"><span class="badge bg-info">3</span> Định mức nghiên cứu khoa học <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('NamHoc_edit') is-invalid @enderror" id="NamHoc_edit" name="NamHoc_edit" value="{{ old('NamHoc_edit') }}" required />
							@error('DinhMucNCKH_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	<div class="mb-3">
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
	<form action="{{ route('supmanager.dinhmucgiangvien.xoa') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete"/>
		<div class="modal fade" id="myModalDelete" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa Định mức của giảng viên</h5>
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
	</form> --}}
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