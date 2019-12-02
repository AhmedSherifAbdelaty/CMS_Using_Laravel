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

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
