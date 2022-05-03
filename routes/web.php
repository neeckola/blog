<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('posts');
});

Route::get('posts/{post}', function($slug) {
    $path = __DIR__ . "/../resources/posts/{$slug}.html";

    if(!file_exists($path)) {
        abort(404);
    }

    $post = cache()->remember("posts.{$slug}", 5, function() use ($path) {
        return file_get_contents($path);
    });

    return view('post', [
        'post' => $post
    ]);
})->where('post', '[A-z_\-]+');