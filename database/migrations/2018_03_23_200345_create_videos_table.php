<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('videos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('description',100)->nullable();
            $table->string('content',100)->nullable();
            $table->string('url',100)->nullable();
            $table->integer('serie_id')->unsigned()->nullable();
            $table->foreign('serie_id')->references('id')->on('series');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('videos');
	}

}
