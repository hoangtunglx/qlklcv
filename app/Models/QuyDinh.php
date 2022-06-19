<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuyDinh extends Model
{
	use HasFactory;
	
	protected $table = 'quydinh';
	protected $primaryKey = null;
	public $incrementing = false;
	
	protected $fillable = [
		'NamHocHienTai', 'NgayMoKeKhai', 'NgayDongKeKhai', 'SoLuongDongTrenMotTrang',
	];
}