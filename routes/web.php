<?php

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', function () {
    return view ('posts', [
        'posts' => Post::latest()->with('category')->get()
    ]);
});
Route::get('/posts/{post:slug}', function (Post $post) { //Post::where('slug', $post)->firstOrFail();
    //Find a post by its slug and then pass it to a view called "post"
    return view('post', [
        'post' => $post
    ]);
});

Route::get('/categories/{category:slug}', function (Category $category) {
   return view('posts', [
       'posts' => $category->posts
   ]);
});

