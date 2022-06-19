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
							<li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}"><i class="fad fa-home-alt"></i></a></li>
							<li class="breadcrumb-item"><a href="{{ route('dashboard.danhmuc.home') }}">Danh mục</a></li>
							<li class="breadcrumb-item active" aria-current="page">Chủ đề</li>
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
			<p><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<div class="table-responsive scrollbar">
				<table id="DataList" class="table table-bordered table-hover table-sm overflow-hidden">
					<thead>
						<tr>
							<th class="text-nowrap" width="5%">#</th>
							<th class="text-nowrap" width="40%">Tên chủ đề</th>
							<th class="text-nowrap" width="40%">Tên chủ đề tiếng Anh</th>
							<th class="text-nowrap" width="5%" title="Thứ tự hiển thị">TT</th>
							<th class="text-nowrap" width="5%">Sửa</th>
							<th class="text-nowrap" width="5%">Xóa</th>
						</tr>
					</thead>
					<tbody>
						@foreach($cms_chude as $value)
							<tr>
								<td class="align-middle">{{ $loop->iteration }}</td>
								<td class="align-middle">
									{{ $value->TenChuDe }}
									<small class="d-block text-muted"><i class="fal fa-tag"></i> <span class="text-primary">{{ $value->TenChuDeKhongDau }}</span></small>
								</td>
								<td class="align-middle">
									{{ $value->TenChuDe_En ?? 'N/A' }}
									<small class="d-block text-muted"><i class="fal fa-tag"></i> <span class="text-primary">{{ $value->TenChuDeKhongDau_En ?? 'N/A' }}</span></small>
								</td>
								<td class="align-middle">{{ $value->ThuTuHienThi }}</td>
								<td class="align-middle text-center"><a href="#sua" data-bs-toggle="modal" data-bs-target="#myModalEdit" onclick="getCapNhat({{ $value->ID }}, '{{ $value->TenChuDe }}', '{{ addslashes($value->TenChuDe_En) }}', {{ $value->ThuTuHienThi }}); return false;"><i class="fal fa-edit"></i></a></td>
								<td class="align-middle text-center pe-1"><a href="#xoa" data-bs-toggle="modal" data-bs-target="#myModalDelete" onclick="getXoa({{ $value->ID }}); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<form action="{{ route('dashboard.danhmuc.chude.them') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<div class="modal fade" id="myModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm chủ đề</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="TenChuDe"><span class="badge bg-info">1</span> Tên chủ đề <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('TenChuDe') is-invalid @enderror" id="TenChuDe" name="TenChuDe" value="{{ old('TenChuDe') }}" required />
							@error('TenChuDe')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="TenChuDe_En"><span class="badge bg-secondary">2</span> Tên chủ đề tiếng Anh</label>
							<input type="text" class="form-control @error('TenChuDe_En') is-invalid @enderror" id="TenChuDe_En" name="TenChuDe_En" value="{{ old('TenChuDe_En') }}" />
							@error('TenChuDe_En')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-0">
							<label class="form-label" for="ThuTuHienThi"><span class="badge bg-secondary">3</span> Thứ tự hiển thị</label>
							<input type="text" class="form-control @error('ThuTuHienThi') is-invalid @enderror" id="ThuTuHienThi" name="ThuTuHienThi" value="1" />
							@error('ThuTuHienThi')
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
	
	<form action="{{ route('dashboard.danhmuc.chude.sua') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật chủ đề</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="TenChuDe_edit"><span class="badge bg-info">1</span> Tên chủ đề <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('TenChuDe_edit') is-invalid @enderror" id="TenChuDe_edit" name="TenChuDe_edit" value="{{ old('TenChuDe_edit') }}" required />
							@error('TenChuDe_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="TenChuDe_En_edit"><span class="badge bg-info">2</span> Tên chủ đề tiếng Anh</label>
							<input type="text" class="form-control @error('TenChuDe_En_edit') is-invalid @enderror" id="TenChuDe_En_edit" name="TenChuDe_En_edit" value="{{ old('TenChuDe_En_edit') }}" />
							@error('TenChuDe_En_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-0">
							<label class="form-label" for="ThuTuHienThi_edit"><span class="badge bg-secondary">3</span> Thứ tự hiển thị</label>
							<input type="text" class="form-control @error('ThuTuHienThi_edit') is-invalid @enderror" id="ThuTuHienThi_edit" name="ThuTuHienThi_edit" value="{{ old('ThuTuHienThi_edit') }}" />
							@error('ThuTuHienThi_edit')
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
	
	<form action="{{ route('dashboard.danhmuc.chude.xoa') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa chủ đề</h5>
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
		function getCapNhat(id, tenChuDe, tenChuDeEn, thuTuHienThi) {
			$('#ID_edit').val(id);
			$('#TenChuDe_edit').val(tenChuDe);
			$('#TenChuDe_En_edit').val(tenChuDeEn);
			$('#ThuTuHienThi_edit').val(thuTuHienThi);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		@if($errors->has('TenChuDe') || $errors->has('TenChuDe_En') || $errors->has('ThuTuHienThi'))
			var myModal = new bootstrap.Modal(document.getElementById('myModal'));
			myModal.show();
		@endif
		
		@if($errors->has('TenChuDe_edit') || $errors->has('TenChuDe_En_edit') || $errors->has('ThuTuHienThi_edit'))
			var myModalEdit = new bootstrap.Modal(document.getElementById('myModalEdit'));
			myModalEdit.show();
		@endif
	</script>
@endsection