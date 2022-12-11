<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function store(Post $post,User $user)
    {
        request()->validate([
            'body'=>'required'
        ]);
        $post->comments()->create([
            'user_id'=>request()->user()->id,
            'body'=>request('body')
        ]);

        return back();
    }
}
