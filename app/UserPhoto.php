<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    protected $uploads = '/images/';

    public function getPathAttribute($path){
        return $this->uploads . $path ;
    }
}
