<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeKhaiHoatDongKhac extends Model
{
	use HasFactory;
	
	protected $table = 'kekhaihoatdongkhac';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaGiangVien', 'ID_QuyDoiGioChuan', 'SoLuong', 'HoSoKemTheo', 'NamHoc',
	];
	
	public function GiangVien()
	{
		return $this->belongsTo(GiangVien::class, 'MaGiangVien', 'MaGiangVien');
	}
	
	public function QuyDoiGioChuan()
	{
		return $this->belongsTo(QuyDoiGioChuan::class, 'ID_QuyDoiGioChuan', 'ID');
	}
}