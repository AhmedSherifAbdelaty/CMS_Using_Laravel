<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Role;
use App\User;
use App\PostPhoto;
use App\UserPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminPostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index' , compact('posts'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all('name' , 'id');
        $categoriesArr = array();
        foreach ($categories as $category){
            $categoriesArr[$category->id] = $category->name;
        }
        return view('admin.posts.create' ,  compact('categoriesArr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('category_id');
        Auth::user()->role->name === 'Administrator' ? $post->is_active = 1 : $post->is_active = 0 ;

        $user = User::find(Auth::user()->id);
        $user->posts()->save($post);

        if($file = $request->file('file')){
            $name = $file->getClientOriginalName();
            $file->move('Postimages' , $name);
            $photo = new PostPhoto();
            $photo->path = $name ;
            $post->photo()->save($photo);
        }
        Session::flash('added_post',' post has been added');

        return redirect('/admin/posts');
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
        $this->authorize('update', Post::find($id));

        $categories = Category::all('name' , 'id');
        $categoriesArr = array();
        foreach ($categories as $category){
            $categoriesArr[$category->id] = $category->name;
        }
        $post = Post::findOrFail($id);
        return view('admin.posts.edit' , compact('post','categoriesArr'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $this->authorize('edit', Post::find($id));

        $post = Post::findorFail($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('category_id');
        Auth::user()->role->name === 'Administrator' ? $post->is_active = 1 : $post->is_active = 0 ;

        $user = User::find(Auth::user()->id);
        $user->posts()->save($post);
        if($file = $request->file('file')){
            $name = $file->getClientOriginalName();
            $file->move('Postimages' , $name);
            $photo = PostPhoto::where('post_id' , $post->id)->first();
            echo $photo;
            if($photo) {
            $photo->path = $name;
            $post->photo()->save($photo);
            }else{
                $photo = new PostPhoto();
                $photo->path = $name ;
                $post->photo()->save($photo);
            }
        }
        Session::flash('updated_post',' post has been updated');
        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('edit', Post::find($id));
        $post = Post::find($id);

        if($post->photo) {
            unlink(public_path() . $post->photo->path);
        }
        $post->delete();
        Session::flash('deleted_post','The post has been deleted');
        return redirect('/admin/posts');
    }



    public function post($id){
        $post = Post::findOrFail($id);
        $comments = $post->comments()->where('is_active' ,1)->get();
        return view('post' , compact('post' , 'comments'));

    }


    public function approvment($id){
        $post = Post::find($id);
        if ($post->is_active == 1)
            $post->is_active = 0;
        else
            $post->is_active = 1 ;

        $post->save();

        return redirect('/admin/posts');
    }

    }

