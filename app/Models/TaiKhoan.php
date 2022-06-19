<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TaiKhoan extends Authenticatable
{
	use HasFactory, Notifiable;
	
	protected $table = 'taikhoan';
	
	protected $fillable = [
		'name', 'username', 'email', 'password', 'privilege',
	];
	
	protected $hidden = [
		'password', 'remember_token'
	];
	
	protected $casts = [
		'email_verified_at' => 'datetime',
	];
}