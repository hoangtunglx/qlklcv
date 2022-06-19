<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
	use HasFactory;
	
	protected $table = 'lop';
	protected $primaryKey = 'MaLop';
	protected $keyType = 'string';
	public $incrementing = false;
	
	protected $fillable = [
		'MaLop', 'MaKhoa', 'TenLop', 'SiSo',
	];
	
	public function Khoa()
	{
		return $this->belongsTo(Khoa::class, 'MaKhoa', 'MaKhoa');
	}
}