<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable =[
      'comment',
      'post_id',
      'user_id'
    ];

    public function replies(){
        return $this->hasMany(CommentReply::class);

    }
}
