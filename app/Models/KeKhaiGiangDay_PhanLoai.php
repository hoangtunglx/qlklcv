<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeKhaiGiangDay_PhanLoai extends Model
{
	use HasFactory;
	
	protected $table = 'kekhaigiangday_phanloai';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'TenLoai',
	];
	
	public function KeKhaiGiangDay_ChiTiet()
	{
		return $this->hasMany(KeKhaiGiangDay_ChiTiet::class, 'MaLoai', 'ID');
	}
}