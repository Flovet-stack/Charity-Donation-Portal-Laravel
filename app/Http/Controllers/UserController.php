<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class UserController extends Controller
{

    public function login(Request $request) {
        $user = User::where(['email' => $request->email])->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return 'Username or password is not matched';
        } else {
            $data = $request->input();
            $request->session()->put('user', $user);
            $request->session()->put('user_id', $user->user_id);
            $request->session()->put('username', $user->username);
            $request->session()->put('email', $user->email);
            $request->session()->put('user_image', $user->user_image);

            return redirect('/');
        }
    }
    
    public function createUser(Request $request)
    {
        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->category = $request->category;
        $user->description = $request->description;
        $user->facebook_link = $request->facebook_link;
        $user->twitter_link = $request->twitter_link;
        $user->instagram_link = $request->instagram_link;
        $user->user_image = $request->image;
        $user->save();

        $request->image->store('image', 'public');

        $credentials = $request->only($user->email, $user->password);

        return redirect('/login');
    }

    public function userProfile($id) {
        $userDetails = Session::get('user');
        return view('user-profile', ['userDetails' => $userDetails]);
    }
}
