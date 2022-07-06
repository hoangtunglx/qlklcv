<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#ffffff" />
	<meta name="author" content="{{ config('app.manage_by', 'ĐHAG') }}" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>@yield('pagetitle', 'Trang chủ') - {{ config('app.name', 'LCMS') }}</title>
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/assets/img/favicons/apple-touch-icon.png') }}" />
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/assets/img/favicons/favicon-32x32.png') }}" />
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/img/favicons/favicon-16x16.png') }}" />
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/img/favicons/favicon.ico') }}" />
	<link rel="manifest" href="{{ asset('public/assets/img/favicons/manifest.json') }}" />
	<script src="{{ asset('public/assets/js/config.js') }}"></script>
	<script src="{{ asset('public/vendors/overlayscrollbars/OverlayScrollbars.min.js') }}"></script>
	<link rel="preconnect" href="https://fonts.gstatic.com" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
	<link rel="stylesheet" href="{{ asset('public/vendors/overlayscrollbars/OverlayScrollbars.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/vendors/choices/choices.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/vendors/fontawesome/5.14.0/css/all.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/theme390.min.css') }}" id="style-default" />
	{{-- select2 --}}
	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> --}}
	
	@yield('css')
	<link rel="stylesheet" href="{{ asset('public/assets/css/user.min.css') }}" id="user-style-default" />
	{{-- <script src="{{ asset('public/js/select2.js') }}"></script> --}}
</head>

<body>
	<main class="main" id="top">
		<div class="container-fluid">
			<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
				<div class="d-flex align-items-center">
					<div class="toggle-icon-wrapper">
						<button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Mở rộng/Thu hẹp menu"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
					</div>
					<a class="navbar-brand" href="{{ route('user.home') }}">
						<div class="d-flex align-items-center py-3"><img class="me-2" src="{{ asset('public/assets/img/logos/agu.png') }}" width="40" /><span class="font-sans-serif">{{ config('app.short_name', 'LCMS') }}</span></div>
					</a>
				</div>
				<div class="collapse navbar-collapse" id="navbarVerticalCollapse">
					<div class="navbar-vertical-content scrollbar">
						<ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
							<li class="nav-item">
								<a class="nav-link" href="{{ route('user.home') }}" role="button">
									<div class="d-flex align-items-center">
										<span class="nav-link-icon"><span class="far fa-fw fa-home"></span></span>
										<span class="nav-link-text">Trang chủ</span>
									</div>
								</a>
							</li>
							@if(Auth::user()->privilege == "admin")
								<li class="nav-item">
									<div class="row navbar-vertical-label-wrapper mt-3 mb-2">
										<div class="col-auto navbar-vertical-label">Quản trị hệ thống</div>
										<div class="col ps-0"><hr class="mb-0 navbar-vertical-divider" /></div>
									</div>
									<a class="nav-link" href="{{ route('admin.taikhoan') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-cog"></span></span>
											<span class="nav-link-text">Tài khoản</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('admin.quydinh') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-sliders-h-square"></span></span>
											<span class="nav-link-text">Quy định chung</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('app.version') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-code-branch"></span></span>
											<span class="nav-link-text">Phiên bản hệ thống</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('app.key') }}" role="button" onclick="return confirm('Bạn muốn tạo khóa mới (APP_KEY) cho hệ thống?');">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-key"></span></span>
											<span class="nav-link-text">Tạo khóa mới</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('app.clear.cache') }}" role="button" onclick="return confirm('Bạn muốn xóa cache hệ thống?');">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-folder-times"></span></span>
											<span class="nav-link-text">Xóa cache hệ thống</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('app.clear.config') }}" role="button" onclick="return confirm('Bạn muốn xóa cache cấu hình?');">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-file-times"></span></span>
											<span class="nav-link-text">Xóa cache cấu hình</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('app.clear.route') }}" role="button" onclick="return confirm('Bạn muốn xóa cache routes?');">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-trash-alt"></span></span>
											<span class="nav-link-text">Xóa cache routes</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('app.clear.view') }}" role="button" onclick="return confirm('Bạn muốn xóa cache views?');">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-calendar-times"></span></span>
											<span class="nav-link-text">Xóa cache views</span>
										</div>
									</a>
									@if(app()->isDownForMaintenance())
										<a class="nav-link" href="{{ route('app.up') }}" role="button" onclick="return confirm('Bạn muốn TẮT chế độ bảo trì trang web?');">
											<div class="d-flex align-items-center">
												<span class="nav-link-icon"><span class="far fa-fw fa-construction"></span></span>
												<span class="nav-link-text">Tắt chế độ bảo trì</span>
											</div>
										</a>
									@else
										<a class="nav-link" href="{{ route('app.down') }}" role="button" onclick="return confirm('Bạn muốn BẬT chế độ bảo trì trang web?');">
											<div class="d-flex align-items-center">
												<span class="nav-link-icon"><span class="far fa-fw fa-construction"></span></span>
												<span class="nav-link-text">Bật chế độ bảo trì</span>
											</div>
										</a>
									@endif
								</li>
							@endif
							@if(Auth::user()->privilege == "admin" || Auth::user()->privilege == "supmanager")
								<li class="nav-item">
									<div class="row navbar-vertical-label-wrapper mt-3 mb-2">
										<div class="col-auto navbar-vertical-label"><a href="{{ route('supmanager.home') }}">Phòng đào tạo</a></div>
										<div class="col ps-0"><hr class="mb-0 navbar-vertical-divider" /></div>
									</div>
									<a class="nav-link" href="{{ route('supmanager.khoa') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-city"></span></span>
											<span class="nav-link-text">Khoa</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.bomon') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-building"></span></span>
											<span class="nav-link-text">Bộ môn</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.lop') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-class"></span></span>
											<span class="nav-link-text">Lớp</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.nganh') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-code-branch"></span></span>
											<span class="nav-link-text">Ngành</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.hocphan') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-book"></span></span>
											<span class="nav-link-text">Học phần</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.dulieuthoikhoabieu') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-calendar-alt"></span></span>
											<span class="nav-link-text">Dữ liệu thời khóa biểu</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.ngach') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-tag"></span></span>
											<span class="nav-link-text">Ngạch giảng viên</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.giangvien') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-chalkboard-teacher"></span></span>
											<span class="nav-link-text">Giảng viên</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.dinhmucbomon') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-ballot-check"></span></span>
											<span class="nav-link-text">Định mức của bộ môn</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.dinhmucgiangvien') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-user-check"></span></span>
											<span class="nav-link-text">Định mức của giảng viên</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.quydoigiamdinhmuc') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-percent"></span></span>
											<span class="nav-link-text">Quy đổi giảm định mức</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.quydoigiochuan') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-clock"></span></span>
											<span class="nav-link-text">Quy đổi giờ chuẩn</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.quydoiheso') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-list-ol"></span></span>
											<span class="nav-link-text">Quy đổi hệ số</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.kekhaigiangday_phanloai') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-cog"></span></span>
											<span class="nav-link-text">Phân loại tiết dạy</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.kekhaigiamdinhmuc') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-cog"></span></span>
											<span class="nav-link-text">Kê khai giảm định mức</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.kekhaigiangday') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-cog"></span></span>
											<span class="nav-link-text">Kê khai giảng dạy</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.kekhaihoatdongkhac') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-cog"></span></span>
											<span class="nav-link-text">Kê khai hoạt động khác</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('supmanager.home') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-cog"></span></span>
											<span class="nav-link-text">Tổng hợp dữ liệu kê khai</span>
										</div>
									</a>
								</li>
							@endif
							@if(Auth::user()->privilege == "admin" || Auth::user()->privilege == "manager")
								<li class="nav-item">
									<div class="row navbar-vertical-label-wrapper mt-3 mb-2">
										<div class="col-auto navbar-vertical-label"><a href="{{ route('manager.home') }}">Bộ môn và Khoa</a></div>
										<div class="col ps-0"><hr class="mb-0 navbar-vertical-divider" /></div>
									</div>
									<a class="nav-link" href="{{ route('manager.dulieuthoikhoabieu') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-user-friends"></span></span>
											<span class="nav-link-text">Dữ liệu thời khóa biểu</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('manager.dinhmucbomon') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-user-tag"></span></span>
											<span class="nav-link-text">Định mức của bộ môn</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('manager.dinhmucgiangvien') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-cog"></span></span>
											<span class="nav-link-text">Định mức của giảng viên</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('manager.kekhaigiamdinhmuc') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-cog"></span></span>
											<span class="nav-link-text">Kê khai giảm định mức</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('manager.kekhaigiangday') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-cog"></span></span>
											<span class="nav-link-text">Kê khai giảng dạy</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('manager.kekhaihoatdongkhac') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-cog"></span></span>
											<span class="nav-link-text">Kê khai hoạt động khác</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('manager.home') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-cog"></span></span>
											<span class="nav-link-text">Tổng hợp dữ liệu kê khai</span>
										</div>
									</a>
								</li>
							@endif
							@if(Auth::user()->privilege == "admin" || Auth::user()->privilege == "statistic")
								<li class="nav-item">
									<div class="row navbar-vertical-label-wrapper mt-3 mb-2">
										<div class="col-auto navbar-vertical-label"><a href="{{ route('statistic.home') }}">Cán bộ thống kê</a></div>
										<div class="col ps-0"><hr class="mb-0 navbar-vertical-divider" /></div>
									</div>
									<a class="nav-link" href="{{ route('statistic.dulieuthoikhoabieu') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-user-friends"></span></span>
											<span class="nav-link-text">Dữ liệu thời khóa biểu</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('statistic.dinhmucbomon') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-user-tag"></span></span>
											<span class="nav-link-text">Định mức của bộ môn</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('statistic.dinhmucgiangvien') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-cog"></span></span>
											<span class="nav-link-text">Định mức của giảng viên</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('statistic.kekhaigiamdinhmuc') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-cog"></span></span>
											<span class="nav-link-text">Kê khai giảm định mức</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('statistic.kekhaigiangday') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-cog"></span></span>
											<span class="nav-link-text">Kê khai giảng dạy</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('statistic.kekhaihoatdongkhac') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-cog"></span></span>
											<span class="nav-link-text">Kê khai hoạt động khác</span>
										</div>
									</a>
									<a class="nav-link" href="{{ route('statistic.home') }}" role="button">
										<div class="d-flex align-items-center">
											<span class="nav-link-icon"><span class="far fa-fw fa-users-cog"></span></span>
											<span class="nav-link-text">Tổng hợp dữ liệu kê khai</span>
										</div>
									</a>
								</li>
							@endif
							<li class="nav-item">
								<div class="row navbar-vertical-label-wrapper mt-3 mb-2">
									<div class="col-auto navbar-vertical-label"><a href="{{ route('user.home') }}">Giảng viên</a></div>
									<div class="col ps-0"><hr class="mb-0 navbar-vertical-divider" /></div>
								</div>
								<a class="nav-link" href="{{ route('user.hoso') }}" role="button">
									<div class="d-flex align-items-center">
										<span class="nav-link-icon"><span class="far fa-fw fa-id-card"></span></span>
										<span class="nav-link-text">Thông tin giảng viên</span>
									</div>
								</a>
								<a class="nav-link" href="{{ route('user.dinhmucgiangvien') }}" role="button">
									<div class="d-flex align-items-center">
										<span class="nav-link-icon"><span class="far fa-fw fa-user-chart"></span></span>
										<span class="nav-link-text">Định mức của giảng viên</span>
									</div>
								</a>
								<a class="nav-link" href="{{ route('user.dulieuthoikhoabieu') }}" role="button">
									<div class="d-flex align-items-center">
										<span class="nav-link-icon"><span class="far fa-fw fa-file-code"></span></span>
										<span class="nav-link-text">Dữ liệu thời khóa biểu</span>
									</div>
								</a>
								<a class="nav-link" href="{{ route('user.kekhaigiamdinhmuc') }}" role="button">
									<div class="d-flex align-items-center">
										<span class="nav-link-icon"><span class="far fa-fw fa-newspaper"></span></span>
										<span class="nav-link-text">Kê khai giảm định mức</span>
									</div>
								</a>
								<a class="nav-link" href="{{ route('user.kekhaigiangday') }}" role="button">
									<div class="d-flex align-items-center">
										<span class="nav-link-icon"><span class="far fa-fw fa-books"></span></span>
										<span class="nav-link-text">Kê khai giảng dạy</span>
									</div>
								</a>
								<a class="nav-link" href="{{ route('user.kekhaihoatdongkhac') }}" role="button">
									<div class="d-flex align-items-center">
										<span class="nav-link-icon"><span class="far fa-fw fa-users-medical"></span></span>
										<span class="nav-link-text">Kê khai hoạt động khác</span>
									</div>
								</a>
								<a class="nav-link" href="{{ route('user.home') }}" role="button">
									<div class="d-flex align-items-center">
										<span class="nav-link-icon"><span class="far fa-fw fa-users-medical"></span></span>
										<span class="nav-link-text">Tổng hợp dữ liệu kê khai</span>
									</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<div class="content">
				<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">
					<button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Mở rộng/Thu hẹp menu"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
					<a class="navbar-brand me-1 me-sm-3" href="{{ route('user.home') }}">
						<div class="d-flex align-items-center"><img class="me-2" src="{{ asset('public/assets/img/logos/agu.png') }}" width="40" /><span class="font-sans-serif">{{ config('app.short_name', 'LCMS') }}</span></div>
					</a>
					<ul class="navbar-nav align-items-center d-none d-lg-block">
						<li class="nav-item">
							<div class="search-box">
								<form class="position-relative">
									<input class="form-control search-input fuzzy-search" type="search" placeholder="Search..." aria-label="Search" />
									<span class="far fa-search search-box-icon"></span>
								</form>
							</div>
						</li>
					</ul>
					<ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
						<li class="nav-item">
							<div class="theme-control-toggle fa-icon-wait px-2">
								<input class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle" type="checkbox" data-theme-control="theme" value="dark" />
								<label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Tắt chế độ ban đêm"><span class="">🌜</span></label>
								<label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Chế độ ban đêm"><span >🌞</span></label>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link pe-0" id="navbarDropdownUser" href="#user" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<div class="avatar avatar-xl"><img class="rounded-circle" src="{{ asset('public/assets/img/icons/noavatar.png') }}" /></div>
							</a>
							<div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
								<div class="bg-white dark__bg-1000 rounded-2 py-2">
									<a class="dropdown-item fw-bold text-warning" href="{{ route('user.hoso') }}"><span class="far fa-fw fa-user"></span> {{ Auth::user()->username }}</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('user.doimatkhau') }}"><span class="far fa-fw fa-key"></span> Đổi mật khẩu</a>
									<a class="dropdown-item" href="{{ route('user.hoso') }}"><span class="far fa-fw fa-id-card"></span> Hồ sơ cá nhân</a>
									<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="far fa-fw fa-power-off"></span> Đăng xuất</a>
									<form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">{{ csrf_field() }}</form>
								</div>
							</div>
						</li>
					</ul>
				</nav>
				@yield('content')
				<footer class="footer">
					<div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
						<div class="col-12 col-sm-auto text-center"><p class="mb-0 text-600">&copy; {{ @date("Y") }} {{ config('app.manage_by', 'ĐHAG') }}</p></div>
						<div class="col-12 col-sm-auto text-center"><p class="mb-0 text-600">v1.0.0622</p></div>
					</div>
				</footer>
			</div>
		</div>
	</main>
	
	<script src="{{ asset('public/vendors/jquery/3.6.0/jquery-3.6.0.min.js') }}"></script>
	<script src="{{ asset('public/vendors/popper.js/2.9.3/popper.min.js') }}"></script>
	<script src="{{ asset('public/vendors/bootstrap/5.1.3/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/vendors/anchorjs/anchor.min.js') }}"></script>
	<script src="{{ asset('public/vendors/is/is.min.js') }}"></script>
	<script src="{{ asset('public/vendors/choices/choices.min.js') }}"></script>

	@yield('javascript')
	<script src="{{ asset('public/assets/js/theme390.js') }}"></script>
</body>

</html>