<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuyDoiHeSo extends Model
{
	use HasFactory;
	
	protected $table = 'quydoiheso';
	protected $primaryKey = 'ID';
	protected $keyType = 'string';
	public $incrementing = false;
	
	protected $fillable = [
		'ID', 'HoatDong', 'HeSo', 'NamHoc',
	];
}