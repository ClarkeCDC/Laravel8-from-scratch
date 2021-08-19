<?php

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/posts', function (){
    return view('posts');
});
Route::get('/posts/{post}', function($slug){
    $path = "resources\posts\\".$slug.".html";
    $post = base_path($path);
    if (!file_exists($post)){
        //ddd("File does not exist");
        //abort(404);
        return redirect("/posts");
    }
    return view('post', [
        'post' => file_get_contents($post)
    ]);
})->where('post','[A-z_\-]+');
require __DIR__.'/auth.php';