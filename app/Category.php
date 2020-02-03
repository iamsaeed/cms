<?php

namespace App;

class Category extends App
{

    public function blogs(){
        return $this->hasMany('App\Blog');
    }


    public function user(){
        return $this->belongsTo('App\User');
    }

}
