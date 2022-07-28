<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupManagerController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoMonController;
use App\Http\Controllers\DinhMucBoMonController;
use App\Http\Controllers\DinhMucGiangVienController;
use App\Http\Controllers\DuLieuThoiKhoaBieuController;
use App\Http\Controllers\GiangVienController;
use App\Http\Controllers\HocPhanController;
use App\Http\Controllers\KeKhaiGiamDinhMucController;
use App\Http\Controllers\KeKhaiGiangDayController;
use App\Http\Controllers\KeKhaiGiangDayPhanLoaiController;
use App\Http\Controllers\KeKhaiHoatDongKhacController;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\LopController;
use App\Http\Controllers\NgachController;
use App\Http\Controllers\NganhController;
use App\Http\Controllers\QuyDinhController;
use App\Http\Controllers\QuyDoiGiamDinhMucController;
use App\Http\Controllers\QuyDoiGioChuanController;
use App\Http\Controllers\QuyDoiHeSoController;
use App\Http\Controllers\TaiKhoanController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

// Trang chủ
Route::get('/', [HomeController::class, 'getHome'])->name('home');
Route::get('/home', [HomeController::class, 'getHome'])->name('home');

// Thông báo
Route::get('/thong-bao', [HomeController::class, 'getBaiViet'])->name('baiviet');
Route::get('/thong-bao/{titleWithID}', [HomeController::class, 'getBaiViet_ChiTiet'])->name('baiviet.chitiet');

// Tải file
Route::post('/van-ban/tai-ve', [HomeController::class, 'postVanBanTaiVe'])->name('vanban.taive');

// Xác thực
Auth::routes(['register' => false]);
Route::get('/login/google', [HomeController::class, 'getGoogleLogin'])->name('google.login');
Route::get('/login/google/callback', [HomeController::class, 'getGoogleCallback'])->name('google.callback');

// Quản trị viên
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function() {
	Route::get('/', [AdminController::class, 'getHome'])->name('home');
	Route::get('/home', [AdminController::class, 'getHome'])->name('home');
	
	Route::get('/taikhoan', [TaiKhoanController::class, 'getDanhSach'])->name('taikhoan');
	Route::post('/taikhoan/them', [TaiKhoanController::class, 'postThem'])->name('taikhoan.them');
	Route::post('/taikhoan/sua', [TaiKhoanController::class, 'postSua'])->name('taikhoan.sua');
	Route::post('/taikhoan/xoa', [TaiKhoanController::class, 'postXoa'])->name('taikhoan.xoa');
	
	Route::get('/quydinh', [QuyDinhController::class, 'getDanhSach'])->name('quydinh');
	Route::post('/quydinh/namhoc', [QuyDinhController::class, 'postSuaNamHoc'])->name('quydinh.suanamhoc');
	Route::post('/quydinh/kekhai', [QuyDinhController::class, 'postSuaThoiGianKeKhai'])->name('quydinh.suathoigian');
});

// Phòng đào tạo
Route::prefix('supmanager')->name('supmanager.')->middleware('supmanager')->group(function() {
	Route::get('/', [SupManagerController::class, 'getHome'])->name('home');
	Route::get('/home', [SupManagerController::class, 'getHome'])->name('home');
	
	Route::get('/khoa', [KhoaController::class, 'getDanhSach'])->name('khoa');
	Route::post('/khoa/them', [KhoaController::class, 'postThem'])->name('khoa.them');
	Route::post('/khoa/sua', [KhoaController::class, 'postSua'])->name('khoa.sua');
	Route::post('/khoa/xoa', [KhoaController::class, 'postXoa'])->name('khoa.xoa');
	Route::get('/khoa/xuat', [KhoaController::class, 'getXuat_SupManager'])->name('khoa.xuat');
	Route::post('/khoa/nhap', [KhoaController::class, 'postNhap_SupManager'])->name('khoa.nhap');
	
	Route::get('/bomon', [BoMonController::class, 'getDanhSach'])->name('bomon');
	Route::post('/bomon/them', [BoMonController::class, 'postThem'])->name('bomon.them');
	Route::post('/bomon/sua', [BoMonController::class, 'postSua'])->name('bomon.sua');
	Route::post('/bomon/xoa', [BoMonController::class, 'postXoa'])->name('bomon.xoa');
	Route::post('/bomon/khoa', [BoMonController::class, 'postDanhSach_Khoa'])->name('bomon.khoa');
	Route::get('/bomon/xuat', [BoMonController::class, 'getXuat_SupManager'])->name('bomon.xuat');
	Route::post('/bomon/nhap', [BoMonController::class, 'postNhap_SupManager'])->name('bomon.nhap');

	Route::get('/lop', [LopController::class, 'getDanhSach'])->name('lop');
	Route::post('/lop/them', [LopController::class, 'postThem'])->name('lop.them');
	Route::post('/lop/sua', [LopController::class, 'postSua'])->name('lop.sua');
	Route::post('/lop/xoa', [LopController::class, 'postXoa'])->name('lop.xoa');
	Route::get('/lop/xuat', [LopController::class, 'getXuat_SupManager'])->name('lop.xuat');
	Route::post('/lop/nhap', [LopController::class, 'postNhap_SupManager'])->name('lop.nhap');
	
	Route::get('/nganh', [NganhController::class, 'getDanhSach'])->name('nganh');
	Route::post('/nganh/them', [NganhController::class, 'postThem'])->name('nganh.them');
	Route::post('/nganh/sua', [NganhController::class, 'postSua'])->name('nganh.sua');
	Route::post('/nganh/xoa', [NganhController::class, 'postXoa'])->name('nganh.xoa');
	Route::post('/nganh/khoa', [NganhController::class, 'postDanhSach_Khoa'])->name('nganh.khoa');
	Route::get('/nganh/xuat', [NganhController::class, 'getXuat_SupManager'])->name('nganh.xuat');
	Route::post('/nganh/nhap', [NganhController::class, 'postNhap_SupManager'])->name('nganh.nhap');
	
	Route::get('/ngach', [NgachController::class, 'getDanhSach'])->name('ngach');
	Route::post('/ngach/them', [NgachController::class, 'postThem'])->name('ngach.them');
	Route::post('/ngach/sua', [NgachController::class, 'postSua'])->name('ngach.sua');
	Route::post('/ngach/xoa', [NgachController::class, 'postXoa'])->name('ngach.xoa');
	
	Route::get('/giangvien', [GiangVienController::class, 'getDanhSach'])->name('giangvien');
	Route::post('/giangvien/them', [GiangVienController::class, 'postThem'])->name('giangvien.them');
	Route::post('/giangvien/sua', [GiangVienController::class, 'postSua'])->name('giangvien.sua');
	Route::post('/giangvien/xoa', [GiangVienController::class, 'postXoa'])->name('giangvien.xoa');
	Route::post('/giangvien/bomon', [GiangVienController::class, 'postDanhSach_BoMon'])->name('giangvien.bomon');
	Route::get('/giangvien/xuat', [GiangVienController::class, 'getXuat_SupManager'])->name('giangvien.xuat');
	Route::post('/giangvien/nhap', [GiangVienController::class, 'postNhap_SupManager'])->name('giangvien.nhap');
	
	Route::get('/dinhmucbomon', [DinhMucBoMonController::class, 'getDanhSach_SupManager'])->name('dinhmucbomon');
	Route::post('/dinhmucbomon/them', [DinhMucBoMonController::class, 'postThem_SupManager'])->name('dinhmucbomon.them');
	Route::post('/dinhmucbomon/sua', [DinhMucBoMonController::class, 'postSua_SupManager'])->name('dinhmucbomon.sua');
	Route::post('/dinhmucbomon/xoa', [DinhMucBoMonController::class, 'postXoa_SupManager'])->name('dinhmucbomon.xoa');
	Route::post('/dinhmucbomon/bomon', [DinhMucBoMonController::class, 'postDanhSach_BoMon_SupManager'])->name('dinhmucbomon.bomon');
	Route::get('/dinhmucbomon/xuat', [DinhMucBoMonController::class, 'getXuat_SupManager'])->name('dinhmucbomon.xuat');
	Route::post('/dinhmucbomon/nhap', [DinhMucBoMonController::class, 'postNhap_SupManager'])->name('dinhmucbomon.nhap');
	
	Route::get('/hocphan', [HocPhanController::class, 'getDanhSach'])->name('hocphan');
	Route::post('/hocphan/them', [HocPhanController::class, 'postThem'])->name('hocphan.them');
	Route::post('/hocphan/sua', [HocPhanController::class, 'postSua'])->name('hocphan.sua');
	Route::post('/hocphan/xoa', [HocPhanController::class, 'postXoa'])->name('hocphan.xoa');
	Route::get('/hocphan/xuat', [HocPhanController::class, 'getXuat'])->name('hocphan.xuat');
	Route::post('/hocphan/nhap', [HocPhanController::class, 'postNhap'])->name('hocphan.nhap');
	
	Route::get('/dulieuthoikhoabieu', [DuLieuThoiKhoaBieuController::class, 'getDanhSach_SupManager'])->name('dulieuthoikhoabieu');
	Route::post('/dulieuthoikhoabieu/them', [DuLieuThoiKhoaBieuController::class, 'postThem_SupManager'])->name('dulieuthoikhoabieu.them');
	Route::post('/dulieuthoikhoabieu/sua', [DuLieuThoiKhoaBieuController::class, 'postSua_SupManager'])->name('dulieuthoikhoabieu.sua');
	Route::post('/dulieuthoikhoabieu/xoa', [DuLieuThoiKhoaBieuController::class, 'postXoa_SupManager'])->name('dulieuthoikhoabieu.xoa');
	Route::get('/dulieuthoikhoabieu/xuat', [DuLieuThoiKhoaBieuController::class, 'getXuat_SupManager'])->name('dulieuthoikhoabieu.xuat');
	Route::post('/dulieuthoikhoabieu/nhap', [DuLieuThoiKhoaBieuController::class, 'postNhap_SupManager'])->name('dulieuthoikhoabieu.nhap');
	
	Route::get('/quydoigiamdinhmuc', [QuyDoiGiamDinhMucController::class, 'getDanhSach'])->name('quydoigiamdinhmuc');
	Route::post('/quydoigiamdinhmuc/them', [QuyDoiGiamDinhMucController::class, 'postThem'])->name('quydoigiamdinhmuc.them');
	Route::post('/quydoigiamdinhmuc/sua', [QuyDoiGiamDinhMucController::class, 'postSua'])->name('quydoigiamdinhmuc.sua');
	Route::post('/quydoigiamdinhmuc/xoa', [QuyDoiGiamDinhMucController::class, 'postXoa'])->name('quydoigiamdinhmuc.xoa');
	Route::get('/quydoigiamdinhmuc/xuat', [QuyDoiGiamDinhMucController::class, 'getXuat'])->name('quydoigiamdinhmuc.xuat');
	Route::post('/quydoigiamdinhmuc/nhap', [QuyDoiGiamDinhMucController::class, 'postNhap'])->name('quydoigiamdinhmuc.nhap');
	
	Route::get('/quydoigiochuan', [QuyDoiGioChuanController::class, 'getDanhSach'])->name('quydoigiochuan');
	Route::post('/quydoigiochuan/them', [QuyDoiGioChuanController::class, 'postThem'])->name('quydoigiochuan.them');
	Route::post('/quydoigiochuan/sua', [QuyDoiGioChuanController::class, 'postSua'])->name('quydoigiochuan.sua');
	Route::post('/quydoigiochuan/xoa', [QuyDoiGioChuanController::class, 'postXoa'])->name('quydoigiochuan.xoa');
	Route::get('/quydoigiochuan/xuat', [QuyDoiGioChuanController::class, 'getXuat'])->name('quydoigiochuan.xuat');
	Route::post('/quydoigiochuan/nhap', [QuyDoiGioChuanController::class, 'postNhap'])->name('quydoigiochuan.nhap');
	
	Route::get('/quydoiheso', [QuyDoiHeSoController::class, 'getDanhSach'])->name('quydoiheso');
	Route::post('/quydoiheso/them', [QuyDoiHeSoController::class, 'postThem'])->name('quydoiheso.them');
	Route::post('/quydoiheso/sua', [QuyDoiHeSoController::class, 'postSua'])->name('quydoiheso.sua');
	Route::post('/quydoiheso/xoa', [QuyDoiHeSoController::class, 'postXoa'])->name('quydoiheso.xoa');
	Route::get('/quydoiheso/xuat', [QuyDoiHeSoController::class, 'getXuat'])->name('quydoiheso.xuat');
	Route::post('/quydoiheso/nhap', [QuyDoiHeSoController::class, 'postNhap'])->name('quydoiheso.nhap');
	
	Route::get('/kekhaigiangday_phanloai', [KeKhaiGiangDayPhanLoaiController::class, 'getDanhSach'])->name('kekhaigiangday_phanloai');
	Route::post('/kekhaigiangday_phanloai/them', [KeKhaiGiangDayPhanLoaiController::class, 'postThem'])->name('kekhaigiangday_phanloai.them');
	Route::post('/kekhaigiangday_phanloai/sua', [KeKhaiGiangDayPhanLoaiController::class, 'postSua'])->name('kekhaigiangday_phanloai.sua');
	Route::post('/kekhaigiangday_phanloai/xoa', [KeKhaiGiangDayPhanLoaiController::class, 'postXoa'])->name('kekhaigiangday_phanloai.xoa');
	
	Route::get('/kekhaigiamdinhmuc', [KeKhaiGiamDinhMucController::class, 'getDanhSach_SupManager'])->name('kekhaigiamdinhmuc');
	Route::post('/kekhaigiamdinhmuc/khoa', [KeKhaiGiamDinhMucController::class, 'getDanhSach_Khoa_SupManager'])->name('kekhaigiamdinhmuc.khoa');
	Route::post('/kekhaigiamdinhmuc/bomon', [KeKhaiGiamDinhMucController::class, 'getDanhSach_MoMon_SupManager'])->name('kekhaigiamdinhmuc.bomon');
	
	Route::get('/kekhaigiangday', [KeKhaiGiangDayController::class, 'getDanhSach_SupManager'])->name('kekhaigiangday');
	Route::post('/kekhaigiangday/khoa', [KeKhaiGiangDayController::class, 'getDanhSach_Khoa_SupManager'])->name('kekhaigiangday.khoa');
	Route::post('/kekhaigiangday/bomon', [KeKhaiGiangDayController::class, 'getDanhSach_MoMon_SupManager'])->name('kekhaigiangday.bomon');
	
	Route::get('/kekhaihoatdongkhac', [KeKhaiHoatDongKhacController::class, 'getDanhSach_SupManager'])->name('kekhaihoatdongkhac');
	Route::post('/kekhaihoatdongkhac/khoa', [KeKhaiHoatDongKhacController::class, 'getDanhSach_Khoa_SupManager'])->name('kekhaihoatdongkhac.khoa');
	Route::post('/kekhaihoatdongkhac/bomon', [KeKhaiHoatDongKhacController::class, 'getDanhSach_MoMon_SupManager'])->name('kekhaihoatdongkhac.bomon');
	
	Route::get('/dinhmucgiangvien', [DinhMucGiangVienController::class, 'getDanhSach_SupManager'])->name('dinhmucgiangvien');
	Route::post('/dinhmucgiangvien/khoa', [DinhMucGiangVienController::class, 'getDanhSach_Khoa_SupManager'])->name('dinhmucgiangvien.khoa');
	Route::post('/dinhmucgiangvien/bomon', [DinhMucGiangVienController::class, 'getDanhSach_BoMon_SupManager'])->name('dinhmucgiangvien.bomon');
});

// Cán bộ thống kê
Route::prefix('statistic')->name('statistic.')->middleware('statistic')->group(function() {
	Route::get('/', [StatisticController::class, 'getHome'])->name('home');
	Route::get('/home', [StatisticController::class, 'getHome'])->name('home');
	
	Route::get('/dinhmucbomon', [DinhMucBoMonController::class, 'getDanhSach_Statistic'])->name('dinhmucbomon');
	Route::post('/dinhmucbomon/khoa', [DinhMucBoMonController::class, 'postDanhSach_Khoa_Statistic'])->name('dinhmucbomon.khoa');
	
	Route::get('/dinhmucgiangvien', [DinhMucGiangVienController::class, 'getDanhSach_Statistic'])->name('dinhmucgiangvien');
	Route::post('/dinhmucgiangvien/khoa', [DinhMucGiangVienController::class, 'postDanhSach_Khoa_Statistic'])->name('dinhmucgiangvien.khoa');
	Route::post('/dinhmucgiangvien/bomon', [DinhMucGiangVienController::class, 'postDanhSach_BoMon_Statistic'])->name('dinhmucgiangvien.bomon');
	
	Route::get('/dulieuthoikhoabieu', [DuLieuThoiKhoaBieuController::class, 'getDanhSach_Statistic'])->name('dulieuthoikhoabieu');
	Route::post('/dulieuthoikhoabieu/khoa', [DuLieuThoiKhoaBieuController::class, 'postDanhSach_Khoa_Statistic'])->name('dulieuthoikhoabieu.khoa');
	Route::post('/dulieuthoikhoabieu/bomon', [DuLieuThoiKhoaBieuController::class, 'postDanhSach_BoMon_Statistic'])->name('dulieuthoikhoabieu.bomon');
	
	Route::get('/kekhaigiamdinhmuc', [KeKhaiGiamDinhMucController::class, 'getDanhSach_Statistic'])->name('kekhaigiamdinhmuc');
	Route::post('/kekhaigiamdinhmuc/khoa', [KeKhaiGiamDinhMucController::class, 'postDanhSach_Khoa_Statistic'])->name('kekhaigiamdinhmuc.khoa');
	Route::post('/kekhaigiamdinhmuc/bomon', [KeKhaiGiamDinhMucController::class, 'postDanhSach_BoMon_Statistic'])->name('kekhaigiamdinhmuc.bomon');
	
	Route::get('/kekhaigiangday', [KeKhaiGiangDayController::class, 'getDanhSach_Statistic'])->name('kekhaigiangday');
	Route::post('/kekhaigiangday/khoa', [KeKhaiGiangDayController::class, 'postDanhSach_Khoa_Statistic'])->name('kekhaigiangday.khoa');
	Route::post('/kekhaigiangday/bomon', [KeKhaiGiangDayController::class, 'postDanhSach_BoMon_Statistic'])->name('kekhaigiangday.bomon');
	
	Route::get('/kekhaihoatdongkhac', [KeKhaiHoatDongKhacController::class, 'getDanhSach_Statistic'])->name('kekhaihoatdongkhac');
	Route::post('/kekhaihoatdongkhac/khoa', [KeKhaiHoatDongKhacController::class, 'postDanhSach_Khoa_Statistic'])->name('kekhaihoatdongkhac.khoa');
	Route::post('/kekhaihoatdongkhac/bomon', [KeKhaiHoatDongKhacController::class, 'postDanhSach_BoMon_Statistic'])->name('kekhaihoatdongkhac.bomon');
});

// Khoa và Bộ môn
Route::prefix('manager')->name('manager.')->middleware('manager')->group(function() {
	Route::get('/', [ManagerController::class, 'getHome'])->name('home');
	Route::get('/home', [ManagerController::class, 'getHome'])->name('home');
	
	Route::get('/dinhmucbomon', [DinhMucBoMonController::class, 'getDanhSach_Manager'])->name('dinhmucbomon');
	
	Route::get('/dinhmucgiangvien', [DinhMucGiangVienController::class, 'getDanhSach_Manager'])->name('dinhmucgiangvien');
	Route::post('/dinhmucgiangvien/bomon', [DinhMucGiangVienController::class, 'postDanhSach_BoMon_Manager'])->name('dinhmucgiangvien.bomon');
	
	Route::get('/dulieuthoikhoabieu', [DuLieuThoiKhoaBieuController::class, 'getDanhSach_Manager'])->name('dulieuthoikhoabieu');
	Route::post('/dulieuthoikhoabieu/bomon', [DuLieuThoiKhoaBieuController::class, 'postDanhSach_BoMon_Manager'])->name('dulieuthoikhoabieu.bomon');
	
	Route::get('/kekhaigiamdinhmuc', [KeKhaiGiamDinhMucController::class, 'getDanhSach_Manager'])->name('kekhaigiamdinhmuc');
	Route::post('/kekhaigiamdinhmuc/bomon', [KeKhaiGiamDinhMucController::class, 'postDanhSach_BoMon_Manager'])->name('kekhaigiamdinhmuc.bomon');
	
	Route::get('/kekhaigiangday', [KeKhaiGiangDayController::class, 'getDanhSach_Manager'])->name('kekhaigiangday');
	Route::post('/kekhaigiangday/bomon', [KeKhaiGiangDayController::class, 'postDanhSach_BoMon_Manager'])->name('kekhaigiangday.bomon');
	
	Route::get('/kekhaihoatdongkhac', [KeKhaiHoatDongKhacController::class, 'getDanhSach_Manager'])->name('kekhaihoatdongkhac');
	Route::post('/kekhaihoatdongkhac/bomon', [KeKhaiHoatDongKhacController::class, 'postDanhSach_BoMon_Manager'])->name('kekhaihoatdongkhac.bomon');
});

// Giảng viên
Route::prefix('user')->name('user.')->middleware('user')->group(function() {
	Route::get('/', [UserController::class, 'getHome'])->name('home');
	Route::get('/home', [UserController::class, 'getHome'])->name('home');
	
	Route::get('/hoso', [UserController::class, 'getHoSo'])->name('hoso');
	Route::post('/hoso', [UserController::class, 'postHoSo'])->name('hoso');
	
	Route::get('/dinhmucgiangvien', [DinhMucGiangVienController::class, 'getDanhSach_User'])->name('dinhmucgiangvien');
	Route::post('/dinhmucgiangvien/them', [DinhMucGiangVienController::class, 'postThem_User'])->name('dinhmucgiangvien.them');
	Route::post('/dinhmucgiangvien/sua', [DinhMucGiangVienController::class, 'postSua_User'])->name('dinhmucgiangvien.sua');
	Route::post('/dinhmucgiangvien/xoa', [DinhMucGiangVienController::class, 'postXoa_User'])->name('dinhmucgiangvien.xoa');
	
	Route::get('/dulieuthoikhoabieu', [DuLieuThoiKhoaBieuController::class, 'getDanhSach_User'])->name('dulieuthoikhoabieu');
	Route::get('/dulieuthoikhoabieu/goiy', [DuLieuThoiKhoaBieuController::class, 'getDanhSach_GoiY_User'])->name('dulieuthoikhoabieu.goiy');
	Route::post('/dulieuthoikhoabieu/luukekhai', [DuLieuThoiKhoaBieuController::class, 'postLuuKeKhai_User'])->name('dulieuthoikhoabieu.luukekhai');
	
	Route::get('/kekhaigiamdinhmuc', [KeKhaiGiamDinhMucController::class, 'getDanhSach_User'])->name('kekhaigiamdinhmuc');
	Route::post('/kekhaigiamdinhmuc/them', [KeKhaiGiamDinhMucController::class, 'postThem_User'])->name('kekhaigiamdinhmuc.them');
	Route::post('/kekhaigiamdinhmuc/sua', [KeKhaiGiamDinhMucController::class, 'postSua_User'])->name('kekhaigiamdinhmuc.sua');
	Route::post('/kekhaigiamdinhmuc/xoa', [KeKhaiGiamDinhMucController::class, 'postXoa_User'])->name('kekhaigiamdinhmuc.xoa');
	
	Route::get('/kekhaigiangday', [KeKhaiGiangDayController::class, 'getDanhSach_User'])->name('kekhaigiangday');
	Route::post('/kekhaigiangday/them', [KeKhaiGiangDayController::class, 'postThem_User'])->name('kekhaigiangday.them');
	Route::post('/kekhaigiangday/sua', [KeKhaiGiangDayController::class, 'postSua_User'])->name('kekhaigiangday.sua');
	Route::post('/kekhaigiangday/xoa', [KeKhaiGiangDayController::class, 'postXoa_User'])->name('kekhaigiangday.xoa');
	
	Route::get('/kekhaihoatdongkhac', [KeKhaiHoatDongKhacController::class, 'getDanhSach_User'])->name('kekhaihoatdongkhac');
	Route::post('/kekhaihoatdongkhac/them', [KeKhaiHoatDongKhacController::class, 'postThem_User'])->name('kekhaihoatdongkhac.them');
	Route::post('/kekhaihoatdongkhac/sua', [KeKhaiHoatDongKhacController::class, 'postSua_User'])->name('kekhaihoatdongkhac.sua');
	Route::post('/kekhaihoatdongkhac/xoa', [KeKhaiHoatDongKhacController::class, 'postXoa_User'])->name('kekhaihoatdongkhac.xoa');
	
	Route::get('/doimatkhau', [UserController::class, 'getDoiMatKhau'])->name('doimatkhau');
	Route::post('/doimatkhau', [UserController::class, 'postDoiMatKhau'])->name('doimatkhau');
});

// Cấu hình
Route::prefix('app')->middleware('auth')->group(function() {
	Route::get('/v', function() {
		$laravel = app();
		return redirect()->route('dashboard.home')->with('status', 'Version: Laravel v' . $laravel::VERSION . ' (PHP v' . PHP_VERSION . ')');
	})->name('app.version');
	
	Route::get('/key', function() {
		Artisan::call('key:generate');
		return redirect()->route('dashboard.home')->with('status', 'Key is generated.');
	})->name('app.key');
	
	Route::get('/down', function() {
		Artisan::call('down');
		return redirect()->route('dashboard.home')->with('status', 'Application is now in maintenance mode.');
	})->name('app.down');
	
	Route::get('/up', function() {
		Artisan::call('up');
		return redirect()->route('dashboard.home')->with('status', 'Application is now live.');
	})->name('app.up');
	
	Route::get('/clear/cache', function() {
		Artisan::call('cache:clear');
		return redirect()->route('dashboard.home')->with('status', 'Application cache is cleared.');
	})->name('app.clear.cache');
	
	Route::get('/clear/config', function() {
		Artisan::call('config:clear');
		return redirect()->route('dashboard.home')->with('status', 'Configuration cache is cleared.');
	})->name('app.clear.config');
	
	Route::get('/clear/route', function() {
		Artisan::call('route:clear');
		return redirect()->route('dashboard.home')->with('status', 'Route cache is cleared.');
	})->name('app.clear.route');
	
	Route::get('/clear/view', function() {
		Artisan::call('view:clear');
		return redirect()->route('dashboard.home')->with('status', 'Compiled views cache are cleared.');
	})->name('app.clear.view');
});