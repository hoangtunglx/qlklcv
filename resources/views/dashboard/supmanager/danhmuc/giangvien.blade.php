@extends('layouts.dashboard')

@section('pagetitle')
	Giảng viên
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
							<li class="breadcrumb-item active" aria-current="page">Giảng viên</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card mb-0">
		<div class="card-header bg-light">
			<h5 class="mb-0">Giảng viên</h5>
		</div>
		<div class="card-body pb-0">
			<form action="{{ route('supmanager.giangvien.bomon') }}" method="POST">
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
			<p>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModalThem"><i class="fal fa-plus"></i> Thêm</button>
				<a href="#nhap" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal"><i class="fal fa-upload"></i> Nhập từ Excel</a>
				<a href="{{route('supmanager.giangvien.xuat')}}" class="btn btn-success"><i class="fal fa-download"></i> Xuất ra Excel</a>
			</p>
			<div class="table-responsive scrollbar">
				<table id="DataList" class="table table-bordered table-hover table-sm overflow-hidden">
					<thead>
						<tr>
							<th class="text-nowrap" width="5%">#</th>
                            <th class="text-nowrap" width="15%">Mã giảng viên</th>
							<th class="text-nowrap" width="20%">Họ tên</th>
							<th class="text-nowrap" width="20%">Email</th>
							<th class="text-nowrap" width="20%">Tên bộ môn</th>
                            <th class="text-nowrap" width="10%">Ngạch</th>
							<th class="text-nowrap" width="5%">Sửa</th>
							<th class="text-nowrap" width="5%">Xóa</th>
						</tr>
					</thead>
					<tbody>
						@foreach($giangvien as $value)
							<tr>
								<td class="align-middle">{{ $loop->iteration }}</td>
								<td class="align-middle">{{ $value->MaGiangVien}}</td>
								<td class="align-middle">{{ $value->HoVaTen }}</td>
                                <td class="align-middle">{{ $value->Email }}</td>
								<td class="align-middle">{{ $value->BoMon->TenBoMon }}</td>
                                <td class="align-middle">{{ $value->Ngach->DienGiai}}</td>
								<td class="align-middle text-center"><a href="#sua" data-bs-toggle="modal" data-bs-target="#myModalEdit" onclick="getCapNhat('{{ $value->MaGiangVien }}', '{{ $value->HoVaTen }}','{{$value->Email}}','{{$value->MaBoMon}}','{{$value->MaNgach}}'); return false;"><i class="fal fa-edit"></i></a></td>
								<td class="align-middle text-center pe-1"><a href="#xoa" data-bs-toggle="modal" data-bs-target="#myModalDelete" onclick="getXoa('{{ $value->MaGiangVien }}'); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="mt-1">
				{{ $giangvien->links() }}
			</div>
		</div>
	</div>
	<form action="{{ route('supmanager.giangvien.them') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<div class="modal fade" id="myModalThem" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm giảng viên</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="MaGiangVien"><span class="badge bg-info">1</span> Mã giảng viên <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('MaGiangVien') is-invalid @enderror" id="MaGiangVien" name="MaGiangVien" value="{{ old('MaGiangVien') }}" required />
							@error('MaGiangVien')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="HoVaTen"><span class="badge bg-info">2</span> Họ và tên <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('HoVaTen') is-invalid @enderror" id="HoVaTen" name="HoVaTen" value="{{ old('HoVaTen') }}" required />
							@error('HoVaTen')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="Email"><span class="badge bg-info">3</span> Email <span class="text-danger fw-bold">*</span></label>
							<input type="email" class="form-control @error('Email') is-invalid @enderror" id="Email" name="Email" value="{{ old('Email') }}" required />
							@error('Email')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-3">
							<label class="form-label" for="MaBoMon"><span class="badge bg-info">4</span> Bộ môn <span class="text-danger fw-bold">*</span></label>
							<select class="form-select @error('MaBoMon') is-invalid @enderror" id="MaBoMon" name="MaBoMon" required>
								<option value="">-- Chọn bộ môn --</option>
                                @foreach($bomon as $value)
								<option value="{{$value->MaBoMon}}" {{ old('MaBoMon') == $value->MaBoMon ? "selected" : "" }}>{{$value->TenBoMon}}</option>
								@endforeach
							</select>
							@error('MaBoMon')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-0">
							<label class="form-label" for="MaNgach"><span class="badge bg-info">5</span> Ngạch <span class="text-danger fw-bold">*</span></label>
							<select class="form-select @error('MaNgach') is-invalid @enderror" id="MaNgach" name="MaNgach" required>
								<option value="">-- Chọn ngạch --</option>
                                @foreach($ngach as $value)
								<option value="{{$value->MaNgach}}" {{ old('MaNgach') == $value->MaNgach ? "selected" : "" }}>{{$value->MaNgach}}</option>
								@endforeach
							</select>
							@error('MaNgach')
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
	<form action="{{ route('supmanager.giangvien.sua') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="id_edit" name="id_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật thông tin giảng viên</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="MaGiangVien_edit"><span class="badge bg-info">1</span> Mã giảng viên <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('MaGiangVien_edit') is-invalid @enderror" id="MaGiangVien_edit" name="MaGiangVien_edit" value="{{ old('MaGiangVien_edit') }}" required />
							@error('MaGiangVien_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="HoVaTen_edit"><span class="badge bg-info">2</span> Họ và tên <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('HoVaTen_edit') is-invalid @enderror" id="HoVaTen_edit" name="HoVaTen_edit" value="{{ old('HoVaTen_edit') }}" required />
							@error('HoVaTen_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="Email_edit"><span class="badge bg-info">3</span> Email <span class="text-danger fw-bold">*</span></label>
							<input type="Email_edit" class="form-control @error('Email_edit') is-invalid @enderror" id="Email_edit" name="Email_edit" value="{{ old('Email_edit') }}" required />
							@error('Email_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-3">
							<label class="form-label" for="MaBoMon_edit"><span class="badge bg-info">4</span> Bộ môn <span class="text-danger fw-bold">*</span></label>
							<select class="form-select @error('MaBoMon_edit') is-invalid @enderror" id="MaBoMon_edit" name="MaBoMon_edit" required>
								<option value="">-- Chọn bộ môn --</option>
                                @foreach($bomon as $value)
								<option value="{{$value->MaBoMon}}" {{ old('MaBoMon_edit') == $value->MaBoMon ? "selected" : "" }}>{{$value->TenBoMon}}</option>
								@endforeach
							</select>
							@error('MaBoMon_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
                        <div class="mb-0">
							<label class="form-label" for="MaNgach_edit"><span class="badge bg-info">5</span> Ngạch <span class="text-danger fw-bold">*</span></label>
							<select class="form-select @error('MaNgach_edit') is-invalid @enderror" id="MaNgach_edit" name="MaNgach_edit" required>
								<option value="">-- Chọn ngạch --</option>
                                @foreach($ngach as $value)
								<option value="{{$value->MaNgach}}" {{ old('MaNgach_edit') == $value->MaNgach ? "selected" : "" }}>{{$value->MaNgach}}</option>
								@endforeach
							</select>
							@error('MaNgach_edit')
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
	<form action="{{ route('supmanager.giangvien.xoa') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="MaGiangVien_delete" name="MaGiangVien_delete"/>
		<div class="modal fade" id="myModalDelete" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa giảng viên</h5>
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
	<form action="{{ route('supmanager.giangvien.nhap') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
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
		function getCapNhat(MaGiangVien, HoVaTen, Email, MaBoMon, MaNgach) {
			$('#id_edit').val(MaGiangVien);
            $('#MaGiangVien_edit').val(MaGiangVien);
            $('#HoVaTen_edit').val(HoVaTen);
            $('#Email_edit').val(Email);
			$('#MaBoMon_edit').val(MaBoMon);
			$('#MaNgach_edit').val(MaNgach);
		}
		
		function getXoa(id) {
			$('#MaGiangVien_delete').val(id);
		}
		
		@if($errors->has('MaGiangVien') || $errors->has('HoVaTen')|| $errors->has('Email')|| $errors->has('MaBoMon')|| $errors->has('MaNgach'))
			var myModalThem = new bootstrap.Modal(document.getElementById('myModalThem'));
			myModalThem.show();
		@endif
		
		@if($errors->has('MaGiangVien_edit') || $errors->has('HoVaTen_edit')|| $errors->has('Email_edit')|| $errors->has('MaBoMon_edit')|| $errors->has('MaNgach_edit'))
			var myModalEdit = new bootstrap.Modal(document.getElementById('myModalEdit'));
			myModalEdit.show();
		@endif
	</script>
@endsection