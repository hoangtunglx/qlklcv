@extends('layouts.dashboard')

@section('pagetitle')
	Ngạch Giảng Viên
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
							<li class="breadcrumb-item active" aria-current="page">Ngạch Giảng Viên</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card mb-0">
		<div class="card-header bg-light">
			<h5 class="mb-0">Ngạch Giảng Viên</h5>
		</div>
		<div class="card-body pb-0">
			<p><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModalThem"><i class="fal fa-plus"></i> Thêm</button></p>
			<div class="table-responsive scrollbar">
				<table id="DataList" class="table table-bordered table-hover table-sm overflow-hidden">
					<thead>
						<tr>
							<th class="text-nowrap" width="5%">#</th>
                            <th class="text-nowrap" width="20%">Mã ngạch</th>
							<th class="text-nowrap" width="20%">Diễn giải</th>
							<th class="text-nowrap" width="20%">Định mức giảng dạy</th>
                            <th class="text-nowrap" width="25%">Định mức nghiên cứu khoa học</th>
							<th class="text-nowrap" width="5%">Sửa</th>
							<th class="text-nowrap" width="5%">Xóa</th>
						</tr>
					</thead>
					<tbody>
						@foreach($ngach as $value)
							<tr>
								<td class="align-middle">{{ $loop->iteration }}</td>
								<td class="align-middle">{{ $value->MaNgach}}</td>
								<td class="align-middle">{{ $value->DienGiai }}</td>
                                <td class="align-middle">{{ $value->DinhMucGiangDay}}</td>
                                <td class="align-middle">{{ $value->DinhMucNCKH}}</td>
								<td class="align-middle text-center"><a href="#sua" data-bs-toggle="modal" data-bs-target="#myModalEdit" onclick="getCapNhat('{{ $value->MaNgach }}', '{{ $value->DienGiai }}','{{$value->DinhMucGiangDay}}','{{$value->DinhMucNCKH}}'); return false;"><i class="fal fa-edit"></i></a></td>
								<td class="align-middle text-center pe-1"><a href="#xoa" data-bs-toggle="modal" data-bs-target="#myModalDelete" onclick="getXoa('{{ $value->MaNgach }}'); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<form action="{{ route('supmanager.ngach.them') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<div class="modal fade" id="myModalThem" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm ngạch giảng viên</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="MaNgach"><span class="badge bg-info">1</span> Mã ngạch <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('MaNgach') is-invalid @enderror" id="MaNgach" name="MaNgach" value="{{ old('MaNgach') }}" required />
							@error('MaNgach')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="DienGiai"><span class="badge bg-info">2</span> Diễn giải <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('DienGiai') is-invalid @enderror" id="DienGiai" name="DienGiai" value="{{ old('DienGiai') }}" required />
							@error('DienGiai')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-3">
							<label class="form-label" for="DinhMucGiangDay"><span class="badge bg-info">3</span> Định mức giảng dạy <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('DinhMucGiangDay') is-invalid @enderror" id="DinhMucGiangDay" name="DinhMucGiangDay" value="{{ old('DinhMucGiangDay') }}" required />
							@error('DinhMucGiangDay')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
                        <div class="mb-3">
							<label class="form-label" for="DinhMucNCKH"><span class="badge bg-info">4</span> Định mức nghiên cứu khoa học <span class="text-danger fw-bold">*</span></label>
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
	<form action="{{ route('supmanager.ngach.sua') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="id_edit" name="id_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật thông tin ngạch giảng viên</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="MaNgach_edit"><span class="badge bg-info">1</span> Mã ngạch <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('MaNgach_edit') is-invalid @enderror" id="MaNgach_edit" name="MaNgach_edit" value="{{ old('MaNgach_edit') }}" required />
							@error('MaNgach_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="DienGiai_edit"><span class="badge bg-info">2</span> Diễn giải <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('DienGiai_edit') is-invalid @enderror" id="DienGiai_edit" name="DienGiai_edit" value="{{ old('DienGiai_edit') }}" required />
							@error('DienGiai_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-3">
							<label class="form-label" for="DinhMucGiangDay_edit"><span class="badge bg-info">3</span> Định mức giảng dạy <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('DinhMucGiangDay_edit') is-invalid @enderror" id="DinhMucGiangDay_edit" name="DinhMucGiangDay_edit" value="{{ old('DinhMucGiangDay_edit') }}" required />
							@error('DinhMucGiangDay_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-3">
							<label class="form-label" for="DinhMucNCKH_edit"><span class="badge bg-info">4</span> Định mức nghiên cứu khoa học <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('DinhMucNCKH_edit') is-invalid @enderror" id="DinhMucNCKH_edit" name="DinhMucNCKH_edit" value="{{ old('DinhMucNCKH_edit') }}" required />
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
	<form action="{{ route('supmanager.ngach.xoa') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="MaNgach_delete" name="MaNgach_delete"/>
		<div class="modal fade" id="myModalDelete" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa ngạch giảng viên</h5>
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
		function getCapNhat(MaNgach, DienGiai, DinhMucGiangDay, DinhMucNCKH) {
			$('#id_edit').val(MaNgach);
            $('#MaNgach_edit').val(MaNgach);
			$('#DienGiai_edit').val(DienGiai);
			$('#DinhMucGiangDay_edit').val(DinhMucGiangDay);
            $('#DinhMucNCKH_edit').val(DinhMucNCKH);
		}
		
		function getXoa(id) {
			$('#MaNgach_delete').val(id);
		}
		
		@if($errors->has('MaNgach') || $errors->has('DienGiai')|| $errors->has('DinhMucGiangDay')|| $errors->has('DinhMucNCKH'))
			var myModalThem = new bootstrap.Modal(document.getElementById('myModalThem'));
			myModalThem.show();
		@endif
		
		@if($errors->has('MaNgach_edit') || $errors->has('DienGiai_edit')|| $errors->has('DinhMucGiangDay_edit')|| $errors->has('DinhMucNCKH_edit'))
			var myModalEdit = new bootstrap.Modal(document.getElementById('myModalEdit'));
			myModalEdit.show();
		@endif
	</script>
@endsection