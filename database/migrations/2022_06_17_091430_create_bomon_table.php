<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoMonTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bomon', function(Blueprint $table) {
			$table->string('MaBoMon', 5)->primary();
			$table->string('MaKhoa', 5);
			$table->string('TenBoMon')->unique();
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
			
			$table->foreign('MaKhoa')->references('MaKhoa')->on('khoa');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('bomon');
	}
}