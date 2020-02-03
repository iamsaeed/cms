<?php

namespace App;

class Tag extends App
{
    public function blogs(){
        return $this->belongsToMany('App\Blog');
    }
}
