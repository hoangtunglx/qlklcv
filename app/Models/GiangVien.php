<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiangVien extends Model
{
	use HasFactory;
	
	protected $table = 'giangvien';
	protected $primaryKey = 'MaGiangVien';
	protected $keyType = 'string';
	public $incrementing = false;
	
	protected $fillable = [
		'MaGiangVien', 'MaNgach', 'MaBoMon', 'HoVaTen', 'Email',
	];
	
	public function BoMon()
	{
		return $this->belongsTo(BoMon::class, 'MaBoMon', 'MaBoMon');
	}
	
	public function Ngach()
	{
		return $this->belongsTo(Ngach::class, 'MaNgach', 'MaNgach');
	}
	
	public function DinhMucGiangVien()
	{
		return $this->hasMany(DinhMucGiangVien::class, 'MaGiangVien', 'MaGiangVien');
	}
	
	public function KeKhaiGiamDinhMuc()
	{
		return $this->hasMany(KeKhaiGiamDinhMuc::class, 'MaGiangVien', 'MaGiangVien');
	}
	
	public function KeKhaiGiangDay()
	{
		return $this->hasMany(KeKhaiGiangDay::class, 'MaGiangVien', 'MaGiangVien');
	}
	
	public function KeKhaiHoatDongKhac()
	{
		return $this->hasMany(KeKhaiHoatDongKhac::class, 'MaGiangVien', 'MaGiangVien');
	}
	
	public function DuLieuThoiKhoaBieu()
	{
		return $this->hasMany(DuLieuThoiKhoaBieu::class, 'MaGiangVien', 'MaGiangVien');
	}
}