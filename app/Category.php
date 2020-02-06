<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends App
{
    use SoftDeletes;

    public function blogs(){
        return $this->hasMany('App\Blog');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}
