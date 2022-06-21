<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeKhaiGiamDinhMuc extends Model
{
	use HasFactory;
	
	protected $table = 'kekhaigiamdinhmuc';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaGiangVien', 'ID_QuyDoiGiamDinhMuc', 'NamHoc',
	];
	
	public function GiangVien()
	{
		return $this->belongsTo(GiangVien::class, 'MaGiangVien', 'MaGiangVien');
	}
	
	public function QuyDoiGiamDinhMuc()
	{
		return $this->belongsTo(QuyDoiGiamDinhMuc::class, 'ID_QuyDoiGiamDinhMuc', 'ID');
	}
}
