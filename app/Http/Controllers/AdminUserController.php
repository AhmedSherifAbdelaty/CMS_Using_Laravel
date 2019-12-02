<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\UserPhoto;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminUserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all('name' , 'id');
        $rolesArr = array();
        foreach ($roles as $role){
            $rolesArr[$role->id] = $role->name;
        }
        return view('admin.users.create' , compact('rolesArr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make(($request->input('password')));
        $user->is_active = $request->input('is_active');
        $role = Role::find($request->input('role_id'));
        $role->users()->save($user);

        if($file = $request->file('file')){
            $name = $file->getClientOriginalName();
            $file->move('images' , $name);
            $photo = new UserPhoto();
            $photo->path = $name ;
            $user2 = User::where('email' , $user->email)->first();
            $user2->photo()->save($photo);
        }
        Session::flash('added_user',' user has been added');
        return redirect('/admin/users');
//        $users = User::all();
//        return view('admin.users.index' , compact('users'));

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
        $user = User::findOrFail($id);

        $roles = Role::all('name' , 'id');
        $rolesArr = array();
        foreach ($roles as $role){
            $rolesArr[$role->id] = $role->name;
        }
        return view('admin.users.edit' , compact('user','rolesArr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findorFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make(($request->input('password')));
        $user->is_active = $request->input('is_active');
        $role = Role::find($request->input('role_id'));
        $role->users()->save($user);

        if($file = $request->file('file')){
            $name = $file->getClientOriginalName();
            $file->move('images' , $name);

            $photo = UserPhoto::where('user_id' , $user->id)->first();
            $user2 = User::where('email' , $user->email)->first();

            if($photo) {
                $photo->path = $name;
                $user2->photo()->save($photo);
            }else{
                $photo = new UserPhoto();
                $photo->path = $name ;
                $user2->photo()->save($photo);
            }
        }
        Session::flash('updated_user','user has been updated');
        return redirect('/admin/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user->photo) {
            unlink(public_path() . $user->photo->path);
        }
        $user->delete();
        Session::flash('deleted_user',' user has been deleted');
        return redirect('/admin/users');
    }
}
