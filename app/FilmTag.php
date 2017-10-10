<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmTag extends Model
{
    protected $table = 'film_tag'; 
    public $timestamps = false;

    protected $fillable = [ 'film_id', 'tag_id'];
}
