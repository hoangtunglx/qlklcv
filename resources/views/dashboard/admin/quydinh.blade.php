@extends('layouts.dashboard')

@section('pagetitle')
	Chủ đề
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
							<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Quản trị hệ thống</a></li>
							<li class="breadcrumb-item active" aria-current="page">Quy định chung</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card mb-0">
		<div class="card-header bg-light">
			<h5 class="mb-0">Chủ đề</h5>
		</div>
		<div class="card-body pb-0">
			{{-- <p><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p> --}}
			<div class="table-responsive scrollbar">
				<table id="DataList" class="table table-bordered table-hover table-sm overflow-hidden">
					<thead>
						<tr>
							<th class="text-nowrap" width="20%">Năm học hiện tại</th>
							<th class="text-nowrap" width="20%">Ngày mở kê khai</th>
							<th class="text-nowrap" width="20%">Ngày đóng kê khai</th>
							<th class="text-nowrap" width="20%">Số lượng dòng trên một trang</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="align-middle">
								<a title="Click để cập nhật 'Năm Học'" href="#suanamhoc" data-bs-toggle="modal" data-bs-target="#myModalEditNamHoc" onclick="getCapNhatNamHoc('{{ $quydinh->NamHocHienTai }}', '{{ $quydinh->NgayMoKeKhai}}', '{{ $quydinh->NgayDongKeKhai}}' ); return false;">{{ $quydinh->NamHocHienTai }}</a>
								
							</td>
							<td class="align-middle">
								<a title="Click để cập nhật 'Ngày Mở Kê Khai'" href="#suangaymokekhai" data-bs-toggle="modal" data-bs-target="#myModalEditThoiGian" onclick="getCapNhatThoiGian('{{ $quydinh->NamHocHienTai }}', '{{ $quydinh->NgayMoKeKhai}}', '{{ $quydinh->NgayDongKeKhai}}' ); return false;">
									{{ Carbon\Carbon::createFromFormat('Y-m-d', $quydinh->NgayMoKeKhai)->format('d/m/Y') }}
								</a>
								
							</td>
							<td class="align-middle">
								<a title="Click để cập nhật 'Ngày Đóng Kê Khai'" href="#suangaydongkekhai" data-bs-toggle="modal" data-bs-target="#myModalEditThoiGian" onclick="getCapNhatThoiGian('{{ $quydinh->NamHocHienTai }}', '{{ $quydinh->NgayMoKeKhai}}', '{{ $quydinh->NgayDongKeKhai}}' ); return false;">
									{{ Carbon\Carbon::createFromFormat('Y-m-d', $quydinh->NgayDongKeKhai)->format('d/m/Y') }}
								</a>
							</td>
							<td class="align-middle">{{ $quydinh->SoLuongDongTrenMotTrang }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	{{-- Edit NamHocHienTai --}}
	<form action="{{ route('admin.quydinh.suanamhoc') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEditNamHoc" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật năm học hiện tại</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="NamHocHienTai_edit"><span class="badge bg-info">1</span> Năm học hiện tại <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('NamHocHienTai_edit') is-invalid @enderror" id="NamHocHienTai_edit" name="NamHocHienTai_edit" value="{{ old('NamHocHienTai_edit') }}" required />
							@error('NamHocHienTai_edit')
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
	{{-- Cap nhat thoi gian ke khai --}}
	<form action="{{ route('admin.quydinh.suathoigian') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="NamHocHienTai_edit_thoigian" name="NamHocHienTai_edit_thoigian" value="" />
		<div class="modal fade" id="myModalEditThoiGian" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật thời gian kê khai</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="NgayMoKeKhai_edit"><span class="badge bg-info">1</span> Ngày mở kê khai <span class="text-danger fw-bold">*</span></label>
							<input type="date" class="form-control @error('NgayMoKeKhai_edit') is-invalid @enderror" id="NgayMoKeKhai_edit" name="NgayMoKeKhai_edit" value="{{ old('NgayMoKeKhai_edit') }}" required />
							@error('NgayMoKeKhai_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="NgayDongKeKhai_edit"><span class="badge bg-info">2</span> Ngày đóng kê khai <span class="text-danger fw-bold">*</span></label>
							<input type="date" class="form-control @error('NgayDongKeKhai_edit') is-invalid @enderror" id="NgayDongKeKhai_edit" name="NgayDongKeKhai_edit" value="{{ old('NgayDongKeKhai_edit') }}" required/>
							@error('NgayDongKeKhai_edit')
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
@endsection

@section('javascript')
	<script>
		function getCapNhatThoiGian(NamHocHienTai, NgayMoKeKhai, NgayDongKeKhai) {
			$('#NamHocHienTai_edit_thoigian').val(NamHocHienTai);
			$('#NgayMoKeKhai_edit').val(NgayMoKeKhai);
			$('#NgayDongKeKhai_edit').val(NgayDongKeKhai);
		}
		function getCapNhatNamHoc(NamHocHienTai) {
			$('#ID_edit').val(NamHocHienTai);
			$('#NamHocHienTai_edit').val(NamHocHienTai);
		}	
		@if($errors->has('NamHocHIenTai_edit'))
			var myModalEditNamHoc = new bootstrap.Modal(document.getElementById('myModalEditNamHoc'));
			myModalEditNamHoc.show();
		@endif
	</script>
@endsection