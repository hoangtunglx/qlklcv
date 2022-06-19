<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeKhaiGiangDay_ChiTiet extends Model
{
	use HasFactory;
	
	protected $table = 'kekhaigiangday_chitiet';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaKeKhaiGiangDay', 'MaLoai', 'SoToThucHanh', 'SoLuongSinhVien', 'SoTietDay', 'HeSoQuyDoi', 'HeSoNgoaiGio', 'HeSoTiengAnh', 'QuyRaGioChuan', 'GhiChu', 'MaGiangVienPhuTrach',
	];
	
	public function KeKhaiGiangDay()
	{
		return $this->belongsTo(KeKhaiGiangDay::class, 'MaKeKhaiGiangDay', 'ID');
	}
	
	public function KeKhaiGiangDay_PhanLoai()
	{
		return $this->belongsTo(KeKhaiGiangDay_PhanLoai::class, 'MaLoai', 'ID');
	}
}