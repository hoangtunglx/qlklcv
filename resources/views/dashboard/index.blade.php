@extends('layouts.dashboard')

@section('pagetitle')
	Trang chủ quản trị
@endsection

@section('content')
	<div class="row mb-3">
		<div class="col">
			<div class="card bg-100 shadow-none border">
				<div class="row gx-0 flex-between-center">
					<div class="col d-flex align-items-center">
						<img class="ms-n2" src="{{ asset('public/assets/img/illustrations/crm-bar-chart.png') }}" width="90" />
						<div>
							<h6 class="text-primary fs--1 mb-0">Hệ thống</h6>
							<h4 class="text-primary fw-bold mb-0">Kê khai <span class="text-info fw-medium">KLCV</span> của giảng viên</h4>
						</div>
						<img class="ms-n4 d-none d-sm-block" src="{{ asset('public/assets/img/illustrations/crm-line-chart.png') }}" width="150" />
					</div>
				</div>
			</div>
		</div>
	</div>
	
	@if(session('status'))
		<div class="alert alert-info border-1 d-flex align-items-center" role="alert">
			<div class="bg-info me-2 icon-item"><span class="fas fa-info-circle text-white fs-3"></span></div>
			<p class="mb-0 flex-1">{{ session('status') }}</p>
			<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	@endif
	
	@if(Auth::user()->privilege == "admin")
		<div class="card mb-3">
			<div class="card-header bg-light">
				<h5 class="mb-0">Quản trị hệ thống</h5>
			</div>
			<div class="card-body fs--1 pb-0">
				<div class="row">
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('admin.taikhoan') }}">Tài khoản</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('admin.quydinh') }}">Quy định chung</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('app.key') }}" onclick="return confirm('Bạn muốn tạo khóa mới (APP_KEY) cho hệ thống?');">Tạo khóa mới</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('app.clear.cache') }}" onclick="return confirm('Bạn muốn xóa cache hệ thống?');">Xóa cache hệ thống</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('app.clear.config') }}" onclick="return confirm('Bạn muốn xóa cache cấu hình?');">Xóa cache cấu hình</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('app.clear.route') }}" onclick="return confirm('Bạn muốn xóa cache routes?');">Xóa cache routes</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('app.clear.view') }}" onclick="return confirm('Bạn muốn xóa cache views?');">Xóa cache views</a></h6>
							</div>
						</div>
					</div>
					@if(app()->isDownForMaintenance())
						<div class="col-sm-6 col-md-4 mb-3">
							<div class="d-flex position-relative align-items-center mb-2">
								<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
								<div class="flex-1">
									<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('app.up') }}" onclick="return confirm('Bạn muốn TẮT chế độ bảo trì trang web?');">Tắt chế độ bảo trì</a></h6>
								</div>
							</div>
						</div>
					@else
						<div class="col-sm-6 col-md-4 mb-3">
							<div class="d-flex position-relative align-items-center mb-2">
								<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
								<div class="flex-1">
									<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('app.down') }}" onclick="return confirm('Bạn muốn BẬT chế độ bảo trì trang web?');">Bật chế độ bảo trì</a></h6>
								</div>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	@endif
	
	@if(Auth::user()->privilege == "admin" || Auth::user()->privilege == "supmanager")
		<div class="card mb-3">
			<div class="card-header bg-light">
				<h5 class="mb-0"><a href="{{ route('supmanager.home') }}">Phòng đào tạo</a></h5>
			</div>
			<div class="card-body fs--1 pb-0">
				<div class="row">
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.khoa') }}">Khoa</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.bomon') }}">Bộ môn</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.lop') }}">Lớp</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.nganh') }}">Ngành</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.hocphan') }}">Học phần</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.dulieuthoikhoabieu') }}"> Dữ liệu thời khóa biểu</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.ngach') }}">Ngạch giảng viên</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.giangvien') }}">Giảng viên</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.dinhmucbomon') }}">Định mức của bộ môn</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.dinhmucgiangvien') }}">Định mức của giảng viên</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.quydoigiamdinhmuc') }}">Quy đổi giảm định mức</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.quydoigiochuan') }}">Quy đổi giờ chuẩn</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.quydoiheso') }}">Quy đổi hệ số</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.kekhaigiangday_phanloai') }}">Phân loại tiết dạy</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.kekhaigiamdinhmuc') }}">Kê khai giảm định mức</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.kekhaigiangday') }}">Kê khai giảng dạy</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.kekhaihoatdongkhac') }}">Kê khai hoạt động khác</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('supmanager.home') }}">Tổng hợp dữ liệu kê khai</a></h6>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
	
	@if(Auth::user()->privilege == "admin" || Auth::user()->privilege == "manager")
		<div class="card mb-3">
			<div class="card-header bg-light">
				<h5 class="mb-0"><a href="{{ route('manager.home') }}">Bộ môn và Khoa</a></h5>
			</div>
			<div class="card-body fs--1 pb-0">
				<div class="row">
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('manager.dulieuthoikhoabieu') }}">Dữ liệu thời khóa biểu</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('manager.dinhmucbomon') }}">Định mức của bộ môn</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('manager.dinhmucgiangvien') }}">Định mức của giảng viên</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('manager.kekhaigiamdinhmuc') }}">Kê khai giảm định mức</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('manager.kekhaigiangday') }}">Kê khai giảng dạy</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('manager.kekhaihoatdongkhac') }}">Kê khai hoạt động khác</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('manager.home') }}">Tổng hợp dữ liệu kê khai</a></h6>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
	
	@if(Auth::user()->privilege == "admin" || Auth::user()->privilege == "statistic")
		<div class="card mb-3">
			<div class="card-header bg-light">
				<h5 class="mb-0"><a href="{{ route('statistic.home') }}">Cán bộ thống kê</a></h5>
			</div>
			<div class="card-body fs--1 pb-0">
				<div class="row">
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('statistic.dulieuthoikhoabieu') }}">Dữ liệu thời khóa biểu</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('statistic.dinhmucbomon') }}">Định mức của bộ môn</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('statistic.dinhmucgiangvien') }}">Định mức của giảng viên</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('statistic.kekhaigiamdinhmuc') }}">Kê khai giảm định mức</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('statistic.kekhaigiangday') }}">Kê khai giảng dạy</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('statistic.kekhaihoatdongkhac') }}">Kê khai hoạt động khác</a></h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 mb-3">
						<div class="d-flex position-relative align-items-center mb-2">
							<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
							<div class="flex-1">
								<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('statistic.home') }}">Tổng hợp dữ liệu kê khai</a></h6>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
	
	<div class="card mb-0">
		<div class="card-header bg-light">
			<h5 class="mb-0"><a href="{{ route('user.home') }}">Giảng viên</a></h5>
		</div>
		<div class="card-body fs--1 pb-0">
			<div class="row">
				<div class="col-sm-6 col-md-4 mb-3">
					<div class="d-flex position-relative align-items-center mb-2">
						<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
						<div class="flex-1">
							<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('user.hoso') }}">Thông tin giảng viên</a></h6>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 mb-3">
					<div class="d-flex position-relative align-items-center mb-2">
						<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
						<div class="flex-1">
							<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('user.dinhmucgiangvien') }}">Định mức của giảng viên</a></h6>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 mb-3">
					<div class="d-flex position-relative align-items-center mb-2">
						<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
						<div class="flex-1">
							<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('user.dulieuthoikhoabieu') }}">Dữ liệu thời khóa biểu</a></h6>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 mb-3">
					<div class="d-flex position-relative align-items-center mb-2">
						<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
						<div class="flex-1">
							<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('user.kekhaigiamdinhmuc') }}">Kê khai giảm định mức</a></h6>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 mb-3">
					<div class="d-flex position-relative align-items-center mb-2">
						<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
						<div class="flex-1">
							<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('user.kekhaigiangday') }}">Kê khai giảng dạy</a></h6>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 mb-3">
					<div class="d-flex position-relative align-items-center mb-2">
						<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
						<div class="flex-1">
							<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('user.kekhaihoatdongkhac') }}">Kê khai hoạt động khác</a></h6>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 mb-3">
					<div class="d-flex position-relative align-items-center mb-2">
						<img class="d-flex align-self-center me-2 rounded-3" src="{{ asset('public/assets/img/icons/folder.png') }}" width="50" />
						<div class="flex-1">
							<h6 class="fs-0 mb-0"><a class="stretched-link" href="{{ route('user.home') }}">Tổng hợp dữ liệu kê khai</a></h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection