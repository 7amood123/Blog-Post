<?php

namespace App\Http\Controllers\Posts;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Page\Controller;

class CategoryController extends Controller
{
    public function create()
    {
        return view('admin.posts.create-category');
    }

    public function store(Request $request)
        {
            $attributes = $request->validate([
                'category' => 'required|string|max:255|unique:categories,name',
            ]);
    
            $attributes['slug'] = Str::slug($attributes['category']);
    
            // Create a new category with UUID
            Category::create([
                'name' => $attributes['category'],
                'slug' => $attributes['slug'],
            ]);
    
            return redirect('/create');
        }
}
