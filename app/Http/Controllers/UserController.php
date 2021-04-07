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
        $user->user_image = $request->file('image')->getClientOriginalName();
        $user->save();

        $imageName = $request->file('image')->getClientOriginalName();
        $destinationPath = 'public/users';

        $request->file('image')->move($destinationPath, $imageName);

        $credentials = ['email' => $request->email, 'password' => $request->password];

        $loggedUser = User::where(['email' => $request->email])->first();
        $request->session()->put('user', $loggedUser);

        return redirect('/login');
    }

    public function userProfile($id) {
        $userDetails = User::where(['username' => $id])->first();
        return view('user-profile', ['userDetails' => $userDetails]);
    }

    public function updateUserProfile(Request $request) {
        $user = User::find(session('user')->id);

        $user->username = $request->username;
        $user->email = $request->email;
        $user->category = $request->category;       
        $user->description = $request->description;
        $user->facebook_link = $request->facebook_link;
        $user->twitter_link = $request->twitter_link;
        $user->instagram_link = $request->instagram_link;
        $user->user_image = $request->file('image')->getClientOriginalName();
        $user->save();

        session('user')->username = $request->username;
        session('user')->email = $request->email;
        session('user')->category = $request->category;       
        session('user')->description = $request->description;
        session('user')->facebook_link = $request->facebook_link;
        session('user')->twitter_link = $request->twitter_link;
        session('user')->instagram_link = $request->instagram_link;
        session('user')->user_image = $request->file('image')->getClientOriginalName();

        $imageName = $request->file('image')->getClientOriginalName();
        $destinationPath = 'public/users';

        $request->file('image')->move($destinationPath, $imageName);
        



        return redirect('/user-profile/'.session('user')->username);
    }

}
