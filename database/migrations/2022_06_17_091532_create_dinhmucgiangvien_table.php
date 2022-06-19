<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDinhMucGiangVienTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dinhmucgiangvien', function(Blueprint $table) {
			$table->id('ID');
			$table->string('MaGiangVien', 10);
			$table->unsignedInteger('DinhMucGiangDay');
			$table->unsignedInteger('DinhMucNCKH');
			$table->string('NamHoc', 9);
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
			
			$table->foreign('MaGiangVien')->references('MaGiangVien')->on('giangvien');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('dinhmucgiangvien');
	}
}