@extends('layouts.dashboard')

@section('pagetitle')
	Người dùng
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
							<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Quản trị hệ thống</a></li>
							<li class="breadcrumb-item active" aria-current="page">Người dùng</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card mb-0">
		<div class="card-header bg-light">
			<h5 class="mb-0">Người dùng</h5>
		</div>
		<div class="card-body pb-0">
			<p><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<div class="table-responsive scrollbar">
				<table id="DataList" class="table table-bordered table-hover table-sm overflow-hidden">
					<thead>
						<tr>
							<th class="text-nowrap" width="5%">#</th>
							<th class="text-nowrap" width="20%">Họ và tên</th>
							<th class="text-nowrap" width="15%">Tên đăng nhập</th>
							<th class="text-nowrap" width="20%">Email</th>
							<th class="text-nowrap" width="10%">Quyền hạn</th>
							<th class="text-nowrap" width="10%">Ngày tạo</th>
							<th class="text-nowrap" width="10%">Ngày sửa</th>
							<th class="text-nowrap" width="5%">Sửa</th>
							<th class="text-nowrap" width="5%">Xóa</th>
						</tr>
					</thead>
					<tbody>
						@foreach($sys_nguoidung as $value)
							<tr>
								<td class="align-middle">{{ $loop->iteration }}</td>
								<td class="align-middle">{{ $value->name }}</td>
								<td class="align-middle font-monospace">{{ $value->username }}</td>
								<td class="align-middle">{{ $value->email }}</td>
								<td class="align-middle small">
									@if($value->privilege == "admin")
										<span class="badge rounded-pill bg-danger">Toàn quyền</span>
									@elseif($value->privilege == "supmanager")
										<span class="badge rounded-pill bg-warning">QL Kê khai</span>
									@elseif($value->privilege == "manager")
										<span class="badge rounded-pill bg-success">Duyệt kê khai</span>
									@elseif($value->privilege == "statistic")
										<span class="badge rounded-pill bg-info">Thống kê</span>
									@elseif($value->privilege == "user")
										<span class="badge rounded-pill bg-secondary">Cán bộ giảng viên</span>									
									@endif
								</td>
								<td class="align-middle small">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y H:i:s') }}</td>
								<td class="align-middle small">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->updated_at)->format('d/m/Y H:i:s') }}</td>
								<td class="align-middle text-center"><a href="#sua" data-bs-toggle="modal" data-bs-target="#myModalEdit" onclick="getCapNhat({{ $value->id }}, '{{ $value->name }}', '{{ $value->username }}', '{{ $value->email }}', '{{ $value->privilege }}'); return false;"><i class="fal fa-edit"></i></a></td>
								<td class="align-middle text-center pe-1"><a href="#xoa" data-bs-toggle="modal" data-bs-target="#myModalDelete" onclick="getXoa({{ $value->id }}); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<form action="{{ route('admin.taikhoan.them') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<div class="modal fade" id="myModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm người dùng</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="name"><span class="badge bg-info">1</span> Họ và tên <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required />
							@error('name')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="username"><span class="badge bg-info">2</span> Tên đăng nhập <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required />
							@error('username')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="email"><span class="badge bg-info">3</span> Email <span class="text-danger fw-bold">*</span></label>
							<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required />
							@error('email')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="password"><span class="badge bg-info">4</span> Mật khẩu <span class="text-danger fw-bold">*</span></label>
							<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required />
							@error('password')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="password_confirmation"><span class="badge bg-info">5</span> Xác nhận mật khẩu <span class="text-danger fw-bold">*</span></label>
							<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required />
							@error('password_confirmation')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-0">
							<label class="form-label" for="privilege"><span class="badge bg-info">6</span> Quyền hạn người dùng <span class="text-danger fw-bold">*</span></label>
							<select class="form-select @error('privilege') is-invalid @enderror" id="privilege" name="privilege" required>
								<option value="">-- Quyền hạn --</option>
								<option value="admin">Toàn quyền</option>
								<option value="supmanager">Quản lý kê khai</option>
								<option value="manager" selected>Duyệt kê khai</option>
								<option value="statistic">Thống kê</option>
								<option value="user">Cán bộ giảng viên</option>
							</select>
							@error('privilege')
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
	<form action="{{ route('admin.taikhoan.sua') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="id_edit" name="id_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật thông tin người dùng</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label" for="name_edit"><span class="badge bg-info">1</span> Họ và tên <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('name_edit') is-invalid @enderror" id="name_edit" name="name_edit" value="{{ old('name_edit') }}" required />
							@error('name_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="username_edit"><span class="badge bg-info">2</span> Tên đăng nhập <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control @error('username_edit') is-invalid @enderror" id="username_edit" name="username_edit" value="{{ old('username_edit') }}" required />
							@error('username_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="email_edit"><span class="badge bg-info">3</span> Email <span class="text-danger fw-bold">*</span></label>
							<input type="email" class="form-control @error('email_edit') is-invalid @enderror" id="email_edit" name="email_edit" value="{{ old('email_edit') }}" required />
							@error('email_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="password_edit"><span class="badge bg-info">4</span> Mật khẩu <span class="text-danger fw-bold">*</span></label>
							<input type="password" class="form-control @error('password_edit') is-invalid @enderror" id="password_edit" name="password_edit" placeholder="Bỏ trống sẽ giữ nguyên mật khẩu cũ" />
							@error('password_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="password_edit_confirmation"><span class="badge bg-info">5</span> Xác nhận mật khẩu <span class="text-danger fw-bold">*</span></label>
							<input type="password" class="form-control @error('password_edit_confirmation') is-invalid @enderror" id="password_edit_confirmation" name="password_edit_confirmation" placeholder="Bỏ trống sẽ giữ nguyên mật khẩu cũ" />
							@error('password_edit_confirmation')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="mb-0">
							<label class="form-label" for="privilege_edit"><span class="badge bg-info">6</span> Quyền hạn người dùng <span class="text-danger fw-bold">*</span></label>
							<select class="form-select @error('privilege_edit') is-invalid @enderror" id="privilege_edit" name="privilege_edit" required>
								<option value="">-- Quyền hạn --</option>
								<option value="admin">Toàn quyền</option>
								<option value="supmanager">Quản lý kê khai</option>
								<option value="manager" selected>Duyệt kê khai</option>
								<option value="statistic">Thống kê</option>
								<option value="user">Cán bộ giảng viên</option>
							</select>
							@error('privilege_edit')
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
	<form action="{{ route('admin.taikhoan.xoa') }}" method="post" class="needs-validation" novalidate>
		@csrf
		<input type="hidden" id="id_delete" name="id_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa người dùng</h5>
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
		function getCapNhat(id, name, username, email, privilege) {
			$('#id_edit').val(id);
			$('#name_edit').val(name);
			$('#username_edit').val(username);
			$('#email_edit').val(email);
			$('#privilege_edit').val(privilege);
		}
		
		function getXoa(id) {
			$('#id_delete').val(id);
		}
		
		@if($errors->has('email') || $errors->has('name') || $errors->has('username') || $errors->has('password') || $errors->has('password_confirmation') || $errors->has('privilege'))
			var myModal = new bootstrap.Modal(document.getElementById('myModal'));
			myModal.show();
		@endif
		
		@if($errors->has('email_edit') || $errors->has('name_edit') || $errors->has('username_edit') || $errors->has('password_edit') || $errors->has('password_edit_confirmation') || $errors->has('privilege_edit'))
			var myModalEdit = new bootstrap.Modal(document.getElementById('myModalEdit'));
			myModalEdit.show();
		@endif
	</script>
@endsection