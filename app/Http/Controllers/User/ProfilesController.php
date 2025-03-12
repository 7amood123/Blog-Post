<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Page\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Clockwork\Request\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    public function show()
    {
        return view('admin.posts.profiles');
    }

    Public function update(ProfileUpdateRequest $request){
        
        // Retrieve the currently authenticated user
        $user = User::find(Auth::user()->id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->age = $request['age'];
        $user->about = $request['about'];
        
        // Save the updated user details
        $user->save();
    
        return redirect('/profiles')->with('status', 'Your profile has been updated successfully!');
    }

    public function toggleSubscription(Request $request)
        { 
            $user = User::find($request['id']); // Ensure this is an instance of User
            if ($user) {
                $user->is_subscribed = !$user->is_subscribed;
                $user->save(); // The save method should now work correctly
        
                return back()->with('status', 'Subscription status updated!');
            } 
            else {
                return back()->withErrors(['error' => 'User not found.']);
            }
        }

}
