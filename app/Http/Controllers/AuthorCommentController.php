<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthorCommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        $this->authorize('update' , $comment);

        return view('Author.comments.edit' , compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $this->authorize('update' , $comment);
        $comment->comment = $request->input('comment');
        Auth::user()->role->name === 'Administrator' ? $comment->is_active = 1 : $comment->is_active = 0 ;
        $comment->save();

        $post = Post::find($comment->post_id);
        $comments = $post->comments ;
        Session::flash('comment_edited','comment has been edtied');

        return redirect("post/$post->id");
//        return redirect()->route('home.post', ['id' => $post->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $this->authorize('update' , $comment);
        $comment->delete();
//
        $post = Post::find($comment->post_id);
        $comments = $post->comments ;
        Session::flash('comment_deleted','comment has been deleted');
        return redirect()->route('home.post', ['id' => $post->id]);


    }
}
