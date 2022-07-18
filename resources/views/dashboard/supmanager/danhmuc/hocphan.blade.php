@extends('layouts.dashboard')

@section('pagetitle')
	Học Phần
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
							<li class="breadcrumb-item active" aria-current="page">Học Phần</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card mb-0">
		<div class="card-header bg-light">
			<h5 class="mb-0">Học Phần</h5>
		</div>
		<div class="card-body pb-0">
			<p>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModalThem"><i class="fal fa-plus"></i> Thêm</button>
				<a href="#nhap" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal"><i class="fal fa-upload"></i> Nhập từ Excel</a>
				<a href="{{ route('supmanager.hocphan.xuat') }}" class="btn btn-success"><i class="fal fa-download"></i> Xuất ra Excel</a>
			</p>
			<div class="table-responsive scrollbar">
				<table id="DataList" class="table table-bordered table-hover table-sm overflow-hidden">
					<thead>
						<tr>
							<th class="text-nowrap" width="5%">#</th>
							<th class="text-nowrap" width="15%">Mã học phần</th>
							<th class="text-nowrap" width="20%">Tên học phần</th>
                            <th class="text-nowrap" width="10%">Số tín chỉ</th>
                            <th class="text-nowrap" width="20%">Số tiết lý thuyết</th>
                            <th class="text-nowrap" width="20%">Số tiết thực hành</th>
							<th class="text-nowrap" width="5%">Sửa</th>
							<th class="text-nowrap" width="5%">Xóa</th>
						</tr>
					</thead>
					<tbody>
						@foreach($hocphan as $value)
							<tr>
								<td class="align-middle">{{ $loop->iteration }}</td>
								<td class="align-middle">{{ $value->MaHocPhan }}</td>
								<td class="align-middle">{{ $value->TenHocPhan }}</td>
                                <td class="align-middle">{{ $value->SoTinChi }}</td>
                                <td class="align-middle">{{ $value->SoTietLyThuyet }}</td>
                                <td class="align-middle">{{ $value->SoTietThucHanh }}</td>
								<td class="align-middle text-center"><a href="#sua" data-bs-toggle="modal" data-bs-target="#myModalEdit" onclick="getCapNhat('{{ $value->MaHocPhan }}', '{{ $value->TenHocPhan }}',{{$value->SoTinChi}}, {{$value->SoTietLyThuyet}},{{$value->SoTietThucHanh}}); return false;"><i class="fal fa-edit"></i></a></td>
								<td class="align-middle text-center pe-1"><a href="#xoa" data-bs-toggle="modal" data-bs-target="#myModalDelete" onclick="getXoa('{{ $value->MaHocPhan }}'); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="mt-1">
				{{ $hocphan->links() }}
			</div>
		</div>
	</div>
	<form action="{{ route('supmanager.hocphan.them') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<div class="modal fade" id="myModalThem" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm học phần</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="MaHocPhan"><span class="badge bg-info">1</span> Mã học phần <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('MaHocPhan') is-invalid @enderror" id="MaHocPhan" name="MaHocPhan" value="{{ old('MaHocPhan') }}" required />
							@error('MaHocPhan')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="TenHocPhan"><span class="badge bg-info">2</span> Tên học phần <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('TenHocPhan') is-invalid @enderror" id="TenHocPhan" name="TenHocPhan" value="{{ old('TenHocPhan') }}" required />
							@error('TenHocPhan')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-3">
							<label class="form-label" for="SoTinChi"><span class="badge bg-info">3</span> Số tín chỉ <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('SoTinChi') is-invalid @enderror" id="SoTinChi" name="SoTinChi" value="{{ old('SoTinChi') }}" required />
							@error('SoTinChi')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-3">
							<label class="form-label" for="SoTietLyThuyet"><span class="badge bg-info">4</span> Số tiết lý thuyết <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('SoTietLyThuyet') is-invalid @enderror" id="SoTietLyThuyet" name="SoTietLyThuyet" value="{{ old('SoTietLyThuyet') }}" required />
							@error('SoTietLyThuyet')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-3">
							<label class="form-label" for="SoTietThucHanh"><span class="badge bg-info">5</span> Số tiết thực hành <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('SoTietThucHanh') is-invalid @enderror" id="SoTietThucHanh" name="SoTietThucHanh" value="{{ old('SoTietThucHanh') }}" required />
							@error('SoTietThucHanh')
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
	<form action="{{ route('supmanager.hocphan.sua') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="id_edit" name="id_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật thông tin học phần</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="MaHocPhan_edit"><span class="badge bg-info">1</span> Mã học phần <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('MaHocPhan_edit') is-invalid @enderror" id="MaHocPhan_edit" name="MaHocPhan_edit" value="{{ old('MaHocPhan_edit') }}" required />
							@error('MaHocPhan_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="TenHocPhan_edit"><span class="badge bg-info">2</span> Tên học phần <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('TenHocPhan_edit') is-invalid @enderror" id="TenHocPhan_edit" name="TenHocPhan_edit" value="{{ old('TenHocPhan_edit') }}" required />
							@error('TenHocPhan_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-3">
							<label class="form-label" for="SoTinChi_edit"><span class="badge bg-info">3</span> Số tín chỉ <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('SoTinChi_edit') is-invalid @enderror" id="SoTinChi_edit" name="SoTinChi_edit" value="{{ old('SoTinChi_edit') }}" required />
							@error('SoTinChi_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-3">
							<label class="form-label" for="SoTietLyThuyet_edit"><span class="badge bg-info">4</span> Số tiết lý thuyết  <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('SoTietLyThuyet_edit') is-invalid @enderror" id="SoTietLyThuyet_edit" name="SoTietLyThuyet_edit" value="{{ old('SoTietLyThuyet_edit') }}" required />
							@error('SoTietLyThuyet_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-3">
							<label class="form-label" for="SoTietThucHanh_edit"><span class="badge bg-info">5</span> Số tiết thực hành <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('SoTietThucHanh_edit') is-invalid @enderror" id="SoTietThucHanh_edit" name="SoTietThucHanh_edit" value="{{ old('SoTietThucHanh_edit') }}" required />
							@error('SoTietThucHanh_edit')
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
	<form action="{{ route('supmanager.hocphan.xoa') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="MaHocPhan_delete" name="MaHocPhan_delete"/>
		<div class="modal fade" id="myModalDelete" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa học phần</h5>
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
	<form action="{{ route('supmanager.hocphan.nhap') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
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
		function getCapNhat(MaHocPhan, TenHocPhan, SoTinChi, SoTietLyThuyet, SoTietThucHanh) {
			$('#id_edit').val(MaHocPhan);
			$('#MaHocPhan_edit').val(MaHocPhan);
			$('#TenHocPhan_edit').val(TenHocPhan);
            $('#SoTinChi_edit').val(SoTinChi);
            $('#SoTietLyThuyet_edit').val(SoTietLyThuyet);
            $('#SoTietThucHanh_edit').val(SoTietThucHanh);
		}
		
		function getXoa(id) {
			$('#MaHocPhan_delete').val(id);
		}
		
		@if($errors->has('MaHocPhan') || $errors->has('TenHocPhan')|| $errors->has('SoTinChi')|| $errors->has('SoTietLyThuyet')|| $errors->has('SoTietThucHanh'))
			var myModalThem = new bootstrap.Modal(document.getElementById('myModalThem'));
			myModalThem.show();
		@endif
		
		@if($errors->has('MaHocPhan_edit') || $errors->has('TenHocPhan_edit')|| $errors->has('SoTinChi_edit')|| $errors->has('SoTietLyThuyet_edit')|| $errors->has('SoTietThucHanh_edit'))
			var myModalEdit = new bootstrap.Modal(document.getElementById('myModalEdit'));
			myModalEdit.show();
		@endif
	</script>
@endsection