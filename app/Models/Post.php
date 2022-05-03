<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post {
    public static function find($slug) {
        return static:all()->firstWhere('slug, $slug');    
    }

    public static function findOrFail($slug) {
        $post = static:find($slug);

        if(!$post) {
            throw new ModelNotFoundException();
        }

        return $post;
    }

    public static function all() {
        $files = File::files(resource_path("posts/"));

        return array_map(fn($file) => $file->getContents(), $files);
    }
}