<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Route::get('/admin', function (){
//    return view('admin.index');
//});

Route::group(['middleware' => 'admin'],function (){
    Route::resource('admin/users' , 'AdminUserController');
    Route::get('/admin' ,function (){
        return view('admin.index');
    });
    Route::resource('admin/posts' , 'AdminPostController');
    Route::resource('admin/categories' , 'AdminCategoryController');
    Route::resource('admin/comments' , 'PostCommentController');
    Route::resource('admin/comments/replies' , 'CommentRepliesController');


});



