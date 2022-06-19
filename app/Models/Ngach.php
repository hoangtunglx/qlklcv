<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ngach extends Model
{
	use HasFactory;
	
	protected $table = 'ngach';
	protected $primaryKey = 'MaNgach';
	protected $keyType = 'string';
	public $incrementing = false;
	
	protected $fillable = [
		'MaNgach', 'DienGiai', 'DinhMucGiangDay', 'DinhMucNCKH',
	];
	
	public function GiangVien()
	{
		return $this->hasMany(GiangVien::class, 'MaNgach', 'MaNgach');
	}
}