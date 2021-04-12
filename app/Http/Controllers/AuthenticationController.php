<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login(Request $request) 
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
           return response()->json([
                'denied' => 'The provided credentials are incorrect.'
           ], 404);
        }

        Auth::login($user);

        $token = $user->createToken('user-token')->plainTextToken;

        $response = ['user' => $user, 'access_token' => $token];

        return response($response, 200);

    }
    
    public function logout() 
    {
        auth()->user()->tokens()->delete();
        Auth::logout();
        return redirect('/');
    }
    
    public function register (Request $request) 
    {

        $request->validate([
            'username' => 'required',
            'email' => 'required | email',
            'password' => 'required'
        ]);

        $user = new User();

        if ($user->exists($request->username)) {
            return response()->json(['error' => 'Username already exists'], 401);
        }

        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        Auth::login($user);

        $token = $user->createToken('user-token')->plainTextToken;

        $response = ['user' => $user, 'access_token' => $token];

        return response($response, 200);

    }
}
