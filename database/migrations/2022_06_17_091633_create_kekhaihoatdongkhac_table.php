<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeKhaiHoatDongKhacTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kekhaihoatdongkhac', function(Blueprint $table) {
			$table->id('ID');
			$table->string('MaGiangVien', 10);
			$table->string('ID_QuyDoiGioChuan', 10);
			$table->unsignedTinyInteger('SoLuong');
			$table->string('HoSoKemTheo')->nullable();
			$table->string('NamHoc', 9);
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
			
			$table->foreign('MaGiangVien')->references('MaGiangVien')->on('giangvien');
			$table->foreign('ID_QuyDoiGioChuan')->references('ID')->on('quydoigiochuan');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('kekhaihoatdongkhac');
	}
}