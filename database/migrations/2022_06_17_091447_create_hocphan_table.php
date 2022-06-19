<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHocPhanTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hocphan', function(Blueprint $table) {
			$table->string('MaHocPhan', 10)->primary();
			$table->string('TenHocPhan');
			$table->unsignedTinyInteger('SoTinChi')->nullable();
			$table->unsignedTinyInteger('SoTietLyThuyet')->nullable();
			$table->unsignedTinyInteger('SoTietThucHanh')->nullable();
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
		Schema::dropIfExists('hocphan');
	}
}