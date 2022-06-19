<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuLieuThoiKhoaBieu extends Model
{
	use HasFactory;
	
	protected $table = 'dulieuthoikhoabieu';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaGiangVien', 'MaHocPhan', 'Nhom', 'ToThucHanh', 'Phong', 'SiSoTKB', 'Thu', 'TietBatDau', 'SoTiet', 'TongSoTiet', 'Lop', 'HocKy', 'NamHoc',
	];
	
	public function HocPhan()
	{
		return $this->belongsTo(HocPhan::class, 'MaHocPhan', 'MaHocPhan');
	}
	
	public function GiangVien()
	{
		return $this->belongsTo(GiangVien::class, 'MaGiangVien', 'MaGiangVien');
	}
}