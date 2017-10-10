<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('film_id');  
			$table->integer('tag_id');  
        });
		
		DB::table('film_tag')->insert([
			['film_id'=>1, 'tag_id'=>1],
			['film_id'=>1, 'tag_id'=>2],
			['film_id'=>2, 'tag_id'=>2],
			['film_id'=>1, 'tag_id'=>3],
			['film_id'=>3, 'tag_id'=>1]
		]);  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('film_tag');
    }
}
