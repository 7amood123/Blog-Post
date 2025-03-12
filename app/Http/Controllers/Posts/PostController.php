<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Page\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(CreatePostRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = Auth::id();
        $validatedData['slug'] = Str::slug($request['title']);

        // Create a new post
        Post::create($validatedData);

        // Redirect to a desired page, for example, the posts index
        return redirect('/');
    }

    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                        request(['search', 'category', 'author'])
                    )->paginate(6)->withQueryString()
        ]);
    }

    public function show($slug)
    {
        // $posts = Post::all();
        // return view('posts.show', [
        //     'posts' => $posts
        // ]);
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('posts.show', [
            'post' => $post
        ]);
    }
}
