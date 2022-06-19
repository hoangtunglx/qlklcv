<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocPhan extends Model
{
	use HasFactory;
	
	protected $table = 'hocphan';
	protected $primaryKey = 'MaHocPhan';
	protected $keyType = 'string';
	public $incrementing = false;
	
	protected $fillable = [
		'MaHocPhan', 'TenHocPhan', 'SoTinChi', 'SoTietLyThuyet', 'SoTietThucHanh',
	];
	
	public function KeKhaiGiangDay()
	{
		return $this->hasMany(KeKhaiGiangDay::class, 'MaHocPhan', 'MaHocPhan');
	}
	
	public function DuLieuThoiKhoaBieu()
	{
		return $this->hasMany(DuLieuThoiKhoaBieu::class, 'MaHocPhan', 'MaHocPhan');
	}
}