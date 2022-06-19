<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeKhaiGiangDay extends Model
{
	use HasFactory;
	
	protected $table = 'kekhaigiangday';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaGiangVien', 'MaHocPhan', 'Nhom', 'Lop', 'HocKy', 'NamHoc',
	];
	
	public function GiangVien()
	{
		return $this->belongsTo(GiangVien::class, 'MaGiangVien', 'MaGiangVien');
	}
	
	public function HocPhan()
	{
		return $this->belongsTo(HocPhan::class, 'MaHocPhan', 'MaHocPhan');
	}
	
	public function KeKhaiGiangDay_ChiTiet()
	{
		return $this->hasMany(KeKhaiGiangDay_ChiTiet::class, 'MaKeKhaiGiangDay', 'ID');
	}
}