<?php

namespace App\Models;


use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post {

    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;
    /**
     * @param $title
     * @param $excerpt
     * @param $date
     * @param $body
     * @param $slug
     */
    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }


    public static function find($slug){
        //of all blog posts - find the one that has matching slug
        $posts = static::all();

        return $posts->firstWhere('slug', $slug);
    }

    public static function all(){
        return collect(File::files(resource_path("posts\\")))
            ->map(function($file){
                return YamlFrontMatter::parseFile($file);
            })
            ->map(function($document){
                return new Post(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug
                );
            });
    }
}
