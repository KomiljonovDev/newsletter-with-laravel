<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Exception;
use Illuminate\Validation\ValidationException;

class NewslatterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {
        request()->validate(['email'=>'required|email']);
        
        try {
            $newsletter->subscribe(request('email'));
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email'=>'This email could not be added to our newsletter list.'
            ]);
        }

        return redirect('/')->with('success','Your now signed up for our newsletter!');
    }
}
