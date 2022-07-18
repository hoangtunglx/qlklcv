<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuyDinhTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quydinh', function(Blueprint $table) {
			$table->string('NamHocHienTai', 9)->default('2021-2022');
			$table->date('NgayMoKeKhai')->default('2022-06-01');
			$table->date('NgayDongKeKhai')->default('2022-06-30');
			$table->unsignedTinyInteger('SoLuongDongTrenMotTrang')->default(1);
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
		Schema::dropIfExists('quydinh');
	}
}