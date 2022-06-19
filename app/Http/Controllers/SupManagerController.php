<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupManagerController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getHome()
	{
		return view('dashboard.index');
	}
}