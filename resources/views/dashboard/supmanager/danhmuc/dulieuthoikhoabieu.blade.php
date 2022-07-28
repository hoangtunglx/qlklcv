@extends('layouts.dashboard')

@section('pagetitle')
	Dữ liệu thời khóa biểu
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
							<li class="breadcrumb-item active" aria-current="page">Dữ liệu thời khóa biểu</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card mb-0">
		<div class="card-header bg-light">
			<h5 class="mb-0">Dữ liệu thời khóa biểu</h5>
		</div>
		<div class="card-body pb-0">
			<p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModalThem"><i class="fal fa-plus"></i> Thêm</button>
                <a href="#nhap" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal"><i class="fal fa-upload"></i> Nhập từ Excel</a>
				<a href="{{route('supmanager.dulieuthoikhoabieu.xuat')}}" class="btn btn-success"><i class="fal fa-download"></i> Xuất ra Excel</a>
            </p>
			<div class="table-responsive scrollbar">
				<table id="DataList" class="table table-bordered table-hover table-sm overflow-hidden">
					<thead>
						<tr>
							<th class="text-nowrap" width="5%">#</th>
							<th class="text-nowrap" width="10%">Mã CBGD</th>
							<th class="text-nowrap" width="10%">Mã HP</th>
                            <th class="text-nowrap" width="5%">Nhóm</th>
							<th class="text-nowrap" width="5%">Tổ TH</th></th>
                            <th class="text-nowrap" width="5%">Phòng</th>
							<th class="text-nowrap" width="5%">Sỉ số TKB</th></th>
                            <th class="text-nowrap" width="5%">Thứ</th>
							<th class="text-nowrap" width="10%">Tiết bắt đầu</th></th>
                            <th class="text-nowrap" width="5%">Số tiết</th>
							<th class="text-nowrap" width="5%">Tổng số tiết</th></th>
                            <th class="text-nowrap" width="10%">Lớp</th>
							<th class="text-nowrap" width="10%">Học kì</th></th>
							<th class="text-nowrap" width="5%">Sửa</th>
							<th class="text-nowrap" width="5%">Xóa</th>
						</tr>
					</thead>
					<tbody>
						@foreach($dulieuthoikhoabieu as $value)
							<tr>
								<td class="align-middle">{{ $loop->iteration }}</td>
								<td class="align-middle">{{ $value->MaGiangVien }}</td>
								<td class="align-middle">{{ $value->MaHocPhan }}</td>
                                <td class="align-middle">{{ $value->Nhom }}</td>
								<td class="align-middle">{{ $value->ToThucHanh }}</td>
                                <td class="align-middle">{{ $value->Phong }}</td>
								<td class="align-middle">{{ $value->SiSoTKB }}</td>
                                <td class="align-middle">{{ $value->Thu }}</td>
								<td class="align-middle">{{ $value->TietBatDau }}</td>
                                <td class="align-middle">{{ $value->SoTiet }}</td>
								<td class="align-middle">{{ $value->TongSoTiet }}</td>
                                <td class="align-middle">{{ $value->Lop }}</td>
								<td class="align-middle">{{ $value->HocKy }}</td>
								<td class="align-middle text-center"><a href="#sua" data-bs-toggle="modal" data-bs-target="#myModalEdit" 
                                    onclick="getCapNhat({{ $value->ID }},'{{ $value->MaGiangVien }}', '{{ $value->MaHocPhan }}','{{ $value->Nhom }}',
                                     '{{ $value->ToThucHanh }}', '{{ $value->Phong }}',{{ $value->SiSoTKB }} ,{{ $value->Thu }} , 
                                     {{ $value->TietBatDau }}, {{ $value->SoTiet }},{{ $value->TongSoTiet }} , '{{ $value->Lop }}',{{ $value->HocKy }} ); return false;"><i class="fal fa-edit"></i></a></td>
								<td class="align-middle text-center pe-1"><a href="#xoa" data-bs-toggle="modal" data-bs-target="#myModalDelete" onclick="getXoa({{ $value->ID }}); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<form action="{{ route('supmanager.dulieuthoikhoabieu.them') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<div class="modal fade" id="myModalThem" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm dữ liệu thời khóa biểu</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
                        <div class="mb-3">
							<label class="form-label" for="MaGiangVien"><span class="badge bg-info">1</span> Giảng viên <span class="text-danger fw-bold">*</span></label>
							<select class="form-select @error('MaGiangVien') is-invalid @enderror" id="MaGiangVien" name="MaGiangVien" required>
								<option value="">-- Chọn Giảng viên --</option>
                                @foreach($giangvien as $value)
								<option value="{{$value->MaGiangVien}}" {{ old('MaGiangVien') == $value->MaGiangVien ? "selected" : "" }}>{{$value->HoVaTen}}</option>
								@endforeach
							</select>
							@error('MaGiangVien')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-3">
							<label class="form-label" for="MaHocPhan"><span class="badge bg-info">2</span> Học phần <span class="text-danger fw-bold">*</span></label>
							<select class="form-select @error('MaHocPhan') is-invalid @enderror" id="MaHocPhan" name="MaHocPhan" required>
								<option value="">-- Chọn Học phần --</option>
                                @foreach($hocphan as $value)
								<option value="{{$value->MaHocPhan}}" {{ old('MaHocPhan') == $value->MaHocPhan ? "selected" : "" }}>{{$value->TenHocPhan}}</option>
								@endforeach
							</select>
							@error('MaHocPhan')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
						<div class="mb-3">
							<label class="form-label" for="Nhom"><span class="badge bg-info">3</span> Nhóm <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('Nhom') is-invalid @enderror" id="Nhom" name="Nhom" value="{{ old('Nhom') }}" required />
							@error('Nhom')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="ToThucHanh"><span class="badge bg-info">4</span> Tổ thực hành </label>
							<input type="text" class="form-control @error('ToThucHanh') is-invalid @enderror" id="ToThucHanh" name="ToThucHanh" value="{{ old('ToThucHanh') }}" />
							@error('ToThucHanh')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-3">
							<label class="form-label" for="Phong"><span class="badge bg-info">5</span> Phòng </label>
							<input type="text" class="form-control @error('Phong') is-invalid @enderror" id="Phong" name="Phong" value="{{ old('Phong') }}" />
							@error('Phong')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>		
                        <div class="mb-3">
							<label class="form-label" for="SiSoTKB"><span class="badge bg-info">6</span> Sỉ số thời khóa biểu <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('SiSoTKB') is-invalid @enderror" id="SiSoTKB" name="SiSoTKB" value="{{ old('SiSoTKB') }}" required />
							@error('SiSoTKB')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
                        <div class="mb-3">
							<label class="form-label" for="Thu"><span class="badge bg-info">7</span> Thứ <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('Thu') is-invalid @enderror" id="Thu" name="Thu" value="{{ old('Thu') }}" required />
							@error('Thu')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
                        <div class="mb-3">
							<label class="form-label" for="TietBatDau"><span class="badge bg-info">8</span> Tiết bắt đầu <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('TietBatDau') is-invalid @enderror" id="TietBatDau" name="TietBatDau" value="{{ old('TietBatDau') }}" required />
							@error('TietBatDau')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
                        <div class="mb-3">
							<label class="form-label" for="SoTiet"><span class="badge bg-info">9</span> Số tiết <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('SoTiet') is-invalid @enderror" id="SoTiet" name="SoTiet" value="{{ old('SoTiet') }}" required />
							@error('SoTiet')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>		
                        <div class="mb-3">
							<label class="form-label" for="TongSoTiet"><span class="badge bg-info">10</span> Tổng số tiết <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('TongSoTiet') is-invalid @enderror" id="TongSoTiet" name="TongSoTiet" value="{{ old('TongSoTiet') }}" required />
							@error('TongSoTiet')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
                        <div class="mb-3">
							<label class="form-label" for="Lop"><span class="badge bg-info">11</span> Lớp <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('Lop') is-invalid @enderror" id="Lop" name="Lop" value="{{ old('Lop') }}" required />
							@error('Lop')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
                        <div class="mb-3">
							<label class="form-label" for="HocKy"><span class="badge bg-info">12</span> Học kỳ <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('HocKy') is-invalid @enderror" id="HocKy" name="HocKy" value="{{ old('HocKy') }}" required />
							@error('HocKy')
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
	<form action="{{ route('supmanager.dulieuthoikhoabieu.sua') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="id_edit" name="id_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật thông dữ liệu thời khóa biểu</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
                    <div class="modal-body">
                        <input type="text" name="ID_edit" id="ID_edit" hidden>
                        <div class="mb-3">
							<label class="form-label" for="MaGiangVien_edit"><span class="badge bg-info">1</span> Giảng viên <span class="text-danger fw-bold">*</span></label>
							<select class="form-select @error('MaGiangVien_edit') is-invalid @enderror" id="MaGiangVien_edit" name="MaGiangVien_edit" required>
								<option value="">-- Chọn Giảng viên --</option>
                                @foreach($giangvien as $value)
								<option value="{{$value->MaGiangVien}}" {{ old('MaGiangVien_edit') == $value->MaGiangVien ? "selected" : "" }}>{{$value->HoVaTen}}</option>
								@endforeach
							</select>
							@error('MaGiangVien_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-3">
							<label class="form-label" for="MaHocPhan_edit"><span class="badge bg-info">2</span> Học phần <span class="text-danger fw-bold">*</span></label>
							<select class="form-select @error('MaHocPhan_edit') is-invalid @enderror" id="MaHocPhan_edit" name="MaHocPhan_edit" required>
								<option value="">-- Chọn Học phần --</option>
                                @foreach($hocphan as $value)
								<option value="{{$value->MaHocPhan}}" {{ old('MaHocPhan_edit') == $value->MaHocPhan ? "selected" : "" }}>{{$value->TenHocPhan}}</option>
								@endforeach
							</select>
							@error('MaHocPhan_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
						<div class="mb-3">
							<label class="form-label" for="Nhom_edit"><span class="badge bg-info">3</span> Nhóm <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('Nhom_edit') is-invalid @enderror" id="Nhom_edit" name="Nhom_edit" value="{{ old('Nhom_edit') }}" required />
							@error('Nhom_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="ToThucHanh_edit"><span class="badge bg-info">4</span> Tổ thực hành </label>
							<input type="text" class="form-control @error('ToThucHanh_edit') is-invalid @enderror" id="ToThucHanh_edit" name="ToThucHanh_edit" value="{{ old('ToThucHanh_edit') }}" />
							@error('ToThucHanh_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
                        <div class="mb-3">
							<label class="form-label" for="Phong_edit"><span class="badge bg-info">5</span> Phòng </label>
							<input type="text" class="form-control @error('Phong_edit') is-invalid @enderror" id="Phong_edit" name="Phong_edit" value="{{ old('Phong_edit') }}" />
							@error('Phong_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>		
                        <div class="mb-3">
							<label class="form-label" for="SiSoTKB_edit"><span class="badge bg-info">6</span> Sỉ số thời khóa biểu <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('SiSoTKB_edit') is-invalid @enderror" id="SiSoTKB_edit" name="SiSoTKB_edit" value="{{ old('SiSoTKB_edit') }}" required />
							@error('SiSoTKB_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
                        <div class="mb-3">
							<label class="form-label" for="Thu_edit"><span class="badge bg-info">7</span> Thứ <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('Thu_edit') is-invalid @enderror" id="Thu_edit" name="Thu_edit" value="{{ old('Thu_edit') }}" required />
							@error('Thu_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
                        <div class="mb-3">
							<label class="form-label" for="TietBatDau_edit"><span class="badge bg-info">8</span> Tiết bắt đầu <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('TietBatDau_edit') is-invalid @enderror" id="TietBatDau_edit" name="TietBatDau_edit" value="{{ old('TietBatDau_edit') }}" required />
							@error('TietBatDau_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
                        <div class="mb-3">
							<label class="form-label" for="SoTiet_edit"><span class="badge bg-info">9</span> Số tiết <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('SoTiet_edit') is-invalid @enderror" id="SoTiet_edit" name="SoTiet_edit" value="{{ old('SoTiet_edit') }}" required />
							@error('SoTiet_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>		
                        <div class="mb-3">
							<label class="form-label" for="TongSoTiet_edit"><span class="badge bg-info">10</span> Tổng số tiết <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('TongSoTiet_edit') is-invalid @enderror" id="TongSoTiet_edit" name="TongSoTiet_edit" value="{{ old('TongSoTiet_edit') }}" required />
							@error('TongSoTiet_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
                        <div class="mb-3">
							<label class="form-label" for="Lop_edit"><span class="badge bg-info">11</span> Lớp <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('Lop_edit') is-invalid @enderror" id="Lop_edit" name="Lop_edit" value="{{ old('Lop_edit') }}" required />
							@error('Lop_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>	
                        <div class="mb-3">
							<label class="form-label" for="HocKy_edit"><span class="badge bg-info">12</span> Học kỳ <span class="text-danger fw-bold">*</span></label>
							<input type="number" class="form-control @error('HocKy_edit') is-invalid @enderror" id="HocKy_edit" name="HocKy_edit" value="{{ old('HocKy_edit') }}" required />
							@error('HocKy_edit')
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
	<form action="{{ route('supmanager.dulieuthoikhoabieu.xoa') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete"/>
		<div class="modal fade" id="myModalDelete" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa dữ liệu thời khóa biểu</h5>
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
		function getCapNhat(ID, MaGiangVien, MaHocPhan, Nhom, ToThucHanh, Phong, SiSoTKB, Thu, TietBatDau, SoTiet, TongSoTiet, Lop, HocKy) {
			$('#ID_edit').val(ID);
			$('#MaGiangVien_edit').val(MaGiangVien);
			$('#MaHocPhan_edit').val(MaHocPhan);
            $('#Nhom_edit').val(Nhom);
            $('#ToThucHanh_edit').val(ToThucHanh);
            $('#Phong_edit').val(Phong);
            $('#SiSoTKB_edit').val(SiSoTKB);
            $('#Thu_edit').val(Thu);
            $('#TietBatDau_edit').val(TietBatDau);
            $('#SoTiet_edit').val(SoTiet);
            $('#TongSoTiet_edit').val(TongSoTiet);
            $('#Lop_edit').val(Lop);
            $('#HocKy_edit').val(HocKy);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		@if($errors->has('MaGiangVien') || $errors->has('MaHocPhan') || $errors->has('Nhom') || $errors->has('ToThucHanh')
            || $errors->has('Phong') || $errors->has('SiSoTKB') || $errors->has('Thu') || $errors->has('TietBatDau')
            || $errors->has('SoTiet') || $errors->has('TongSoTiet') || $errors->has('Lop') || $errors->has('HocKy')
        )
			var myModalThem = new bootstrap.Modal(document.getElementById('myModalThem'));
			myModalThem.show();
		@endif
		
		@if($errors->has('MaGiangVien_edit') || $errors->has('MaHocPhan_edit') || $errors->has('Nhom_edit') || $errors->has('ToThucHanh_edit')
            || $errors->has('Phong_edit') || $errors->has('SiSoTKB_edit') || $errors->has('Thu_edit') || $errors->has('TietBatDau_edit')
            || $errors->has('SoTiet_edit') || $errors->has('TongSoTiet_edit') || $errors->has('Lop_edit') || $errors->has('HocKy_edit')
        )
			var myModalEdit = new bootstrap.Modal(document.getElementById('myModalEdit'));
			myModalEdit.show();
		@endif
	</script>
@endsection