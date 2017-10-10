<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'film'; 
    public $timestamps = false;

    protected $fillable = [ 'title', 'year'];

    public function tags(){
        return  $this->belongsToMany('App\Tag', 'film_tag', 'film_id', 'tag_id');
    }
}
