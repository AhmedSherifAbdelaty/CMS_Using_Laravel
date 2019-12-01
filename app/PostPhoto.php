<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostPhoto extends Model
{
    protected $uploads = '/Postimages/';

    public function getPathAttribute($path){
        return $this->uploads . $path ;
    }
}
