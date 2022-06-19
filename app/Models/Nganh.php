<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nganh extends Model
{
	use HasFactory;
	
	protected $table = 'nganh';
	protected $primaryKey = 'MaNganh';
	protected $keyType = 'string';
	public $incrementing = false;
	
	protected $fillable = [
		'MaNganh', 'MaKhoa', 'TenNganh',
	];
	
	public function Khoa()
	{
		return $this->belongsTo(Khoa::class, 'MaKhoa', 'MaKhoa');
	}
}