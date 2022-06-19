<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuyDoiGiamDinhMuc extends Model
{
	use HasFactory;
	
	protected $table = 'quydoigiamdinhmuc';
	protected $primaryKey = 'ID';
	protected $keyType = 'string';
	public $incrementing = false;
	
	protected $fillable = [
		'ID', 'HoatDong', 'PhanTramDinhMuc', 'NamHoc',
	];
	
	public function KeKhaiGiamDinhMuc()
	{
		return $this->hasMany(KeKhaiGiamDinhMuc::class, 'ID_QuyDoiGiamDinhMuc', 'ID');
	}
}