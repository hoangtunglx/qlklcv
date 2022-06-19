<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoMon extends Model
{
	use HasFactory;
	
	protected $table = 'bomon';
	protected $primaryKey = 'MaBoMon';
	protected $keyType = 'string';
	public $incrementing = false;
	
	protected $fillable = [
		'MaBoMon', 'MaKhoa', 'TenBoMon',
	];
	
	public function Khoa()
	{
		return $this->belongsTo(Khoa::class, 'MaKhoa', 'MaKhoa');
	}
	
	public function GiangVien()
	{
		return $this->hasMany(GiangVien::class, 'MaBoMon', 'MaBoMon');
	}
	
	public function DinhMucBoMon()
	{
		return $this->hasMany(DinhMucBoMon::class, 'MaBoMon', 'MaBoMon');
	}
}