<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function login(Request $request)
    {
        
        $user = User::where('username', $request['username'])->firstOrFail();

        if (!$user OR !Hash::check($request['password'], $user->password))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $token = $user->generateToken();

        return response()
            ->json(['message' => 'Hi '.$user->name.', welcome to home','access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->deleteToken();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
