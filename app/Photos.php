<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
protected $fillable=array('album_id','description','photo','title','size');


    public function album(){
        $this->belongsTo('App\Album');
    }
}
