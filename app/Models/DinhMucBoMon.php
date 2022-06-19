<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DinhMucBoMon extends Model
{
	use HasFactory;
	
	protected $table = 'dinhmucbomon';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaBoMon', 'TongDinhMuc', 'NamHoc',
	];
	
	public function BoMon()
	{
		return $this->belongsTo(BoMon::class, 'MaBoMon', 'MaBoMon');
	}
}