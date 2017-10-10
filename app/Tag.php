<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag'; 
    public $timestamps = false;
    protected $fillable = [ 'title'];

    public function films(){
        return  $this->belongsToMany('App\Film', 'film_tag', 'tag_id', 'film_id');
    }
}
