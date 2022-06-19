<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeKhaiGiangDayTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kekhaigiangday', function(Blueprint $table) {
			$table->id('ID');
			$table->string('MaGiangVien', 10);
			$table->string('MaHocPhan', 10);
			$table->string('Nhom', 3);
			$table->string('Lop', 50);
			$table->unsignedTinyInteger('HocKy');
			$table->string('NamHoc', 9);
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
			
			$table->foreign('MaGiangVien')->references('MaGiangVien')->on('giangvien');
			$table->foreign('MaHocPhan')->references('MaHocPhan')->on('hocphan');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('kekhaigiangday');
	}
}