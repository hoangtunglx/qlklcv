<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuyDoiGioChuan extends Model
{
	use HasFactory;
	
	protected $table = 'quydoigiochuan';
	protected $primaryKey = 'ID';
	protected $keyType = 'string';
	public $incrementing = false;
	
	protected $fillable = [
		'ID', 'HoatDong', 'GioChuan', 'NamHoc',
	];
	
	public function KeKhaiHoatDongKhac()
	{
		return $this->hasMany(KeKhaiHoatDongKhac::class, 'ID_QuyDoiGioChuan', 'ID');
	}
}