<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DinhMucGiangVien extends Model
{
	use HasFactory;
	
	protected $table = 'dinhmucgiangvien';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaGiangVien', 'DinhMucGiangDay', 'DinhMucNCKH', 'NamHoc',
	];
	
	public function GiangVien()
	{
		return $this->belongsTo(GiangVien::class, 'MaGiangVien', 'MaGiangVien');
	}
}