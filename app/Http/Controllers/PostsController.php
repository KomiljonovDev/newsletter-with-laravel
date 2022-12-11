<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class PostsController extends Controller
{
    public function index()
    {
        return view('posts.index',[
            'posts'=>Post::latest()->filter(
                    request(['search', 'category','author'])
                )->Paginate(18)->withQueryString()
        ]);
    }
    public function show(Post $post)
    {
        return view('posts.show',[
            'post'=>$post
        ]);
    }
}
