<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeKhaiGiangDayChiTietTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kekhaigiangday_chitiet', function(Blueprint $table) {
			$table->id('ID');
			$table->foreignId('MaKeKhaiGiangDay')->constrained()->on('kekhaigiangday');
			$table->foreignId('MaLoai')->constrained()->on('kekhaigiangday_phanloai');
			$table->unsignedTinyInteger('SoToThucHanh')->nullable();
			$table->unsignedTinyInteger('SoLuongSinhVien')->nullable();
			$table->unsignedTinyInteger('SoTietDay')->nullable();
			$table->float('HeSoQuyDoi')->nullable();
			$table->float('HeSoNgoaiGio')->nullable();
			$table->float('HeSoTiengAnh')->nullable();
			$table->float('QuyRaGioChuan')->nullable();
			$table->string('GhiChu')->nullable();
			$table->string('MaGiangVienPhuTrach')->nullable(); // Nếu có người khác dạy
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('kekhaigiangday_chitiet');
	}
}