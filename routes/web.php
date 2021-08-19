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
    if (!file_exists($path = base_path("resources\posts\\".$slug.".html"))){
        //ddd("File does not exist");
        //abort(404);
        return redirect("/posts");
    }

    
    $post = cache()->remember("posts.{$slug}", 1200, function () use($path) { // use (path) passes through variable so it accesiblle
        return file_get_contents($path);
    });
    
    return view('post', [
        'post' => $post
    ]);
})->where('post','[A-z_\-]+');
require __DIR__.'/auth.php';
