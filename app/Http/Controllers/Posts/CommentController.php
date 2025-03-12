<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use App\Http\Controllers\Page\Controller;

class CommentController extends Controller
{
    public function index(){
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                        request(['search', 'category', 'author'])
                    )->paginate(3)->withQueryString()
        ]);
    }
}
