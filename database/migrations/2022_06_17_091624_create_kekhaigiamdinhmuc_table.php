<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeKhaiGiamDinhMucTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kekhaigiamdinhmuc', function(Blueprint $table) {
			$table->id('ID');
			$table->string('MaGiangVien', 10);
			$table->string('ID_QuyDoiGiamDinhMuc', 10);
			$table->string('NamHoc', 9);
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
			
			$table->foreign('MaGiangVien')->references('MaGiangVien')->on('giangvien');
			$table->foreign('ID_QuyDoiGiamDinhMuc')->references('ID')->on('quydoigiamdinhmuc');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('kekhaigiamdinhmuc');
	}
}