<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Page\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store(RegisterRequest $request)
    {
        $user = auth()->login(User::create($request));
        event(new Registered($user)); 

        return redirect('/')->with('success', 'Your account has been created.');
    }
}
