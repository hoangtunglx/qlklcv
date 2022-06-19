<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiangVienTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('giangvien', function(Blueprint $table) {
			$table->string('MaGiangVien', 10)->primary();
			$table->string('MaNgach', 10);
			$table->string('MaBoMon', 5);
			$table->string('HoVaTen');
			$table->string('Email');
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
			
			$table->foreign('MaNgach')->references('MaNgach')->on('ngach');
			$table->foreign('MaBoMon')->references('MaBoMon')->on('bomon');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('giangvien');
	}
}