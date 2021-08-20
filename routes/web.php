<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Facades\File;
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

Route::get('/posts', function () {
    $files = File::files(resource_path("posts\\"));
    $documents = [];
    foreach ($files as $file){
        $document[] = YamlFrontMatter::parseFile($file);
    }
    // return view('posts',[
    //     'posts' => Post::all()
    // ]);
});
Route::get('/posts/{post}', function ($slug) {
    //Find a post by its slug and then pass it to a view called "post"
    return view('post', [
        'post' => Post::find($slug)
    ]);
})->where('post', '[A-z_\-]+');

require __DIR__ . '/auth.php';
