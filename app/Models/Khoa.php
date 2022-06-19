<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
	use HasFactory;
	
	protected $table = 'khoa';
	protected $primaryKey = 'MaKhoa';
	protected $keyType = 'string';
	public $incrementing = false;
	
	protected $fillable = [
		'MaKhoa', '	TenKhoa',
	];
	
	public function BoMon()
	{
		return $this->hasMany(BoMon::class, 'MaKhoa', 'MaKhoa');
	}
	
	public function Lop()
	{
		return $this->hasMany(Lop::class, 'MaKhoa', 'MaKhoa');
	}
	
	public function Nganh()
	{
		return $this->hasMany(Nganh::class, 'MaKhoa', 'MaKhoa');
	}
}