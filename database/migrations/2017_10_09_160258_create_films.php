<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');           
            $table->string('year');;
        
        });
		
		DB::table('film')->insert([
			['title'=>'Тёмная башня', 'year' => '2017'],
			['title'=>'Великолепная семерка', 'year' => '2016'],
			['title'=>' Человек-паук: Возвращение домой', 'year' => '2017'],
		]); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('film');
    }
}
