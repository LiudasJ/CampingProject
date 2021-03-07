<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login(Request $request) {

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['Failed to login']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = ['user' => $user, 'token' => $token];
        return response($response, 201);

    }
    
    public function register (Request $request) {

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
        
        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = ['user' => $user, 'token' => $token];

        return response($response, 200);

    }
}
