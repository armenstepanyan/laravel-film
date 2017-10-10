<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();       
        });
		
		DB::table('tag')->insert([
			['title'=>'Фантастика'],
			['title'=>'Боевики'],
			['title'=>'Вестерны'],
			['title'=>'Военные'],
			['title'=>'Детективы']
		]);   
          
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tag');
    }
}
