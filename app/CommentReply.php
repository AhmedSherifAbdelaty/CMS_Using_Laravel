<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    protected $fillable =[
        'comment',
        'comment_id',
        'user_id'
    ];


    public function comment (){
        return $this->belongsTo(Comment::class);
    }
}
