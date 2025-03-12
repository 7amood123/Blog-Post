<?php

// app/Http/Controllers/VerificationController.php
namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/')->with("You're already verified");
        }

        $request->user()->sendEmailVerificationNotification();

        session()->regenerate();

        return back()->with('resent', true, 'check your email!');
    }
}

