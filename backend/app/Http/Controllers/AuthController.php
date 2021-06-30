<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register Users.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request  $request)
    {

        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' =>$fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

        $token = $user->createToken('bonvoyage_app_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return \response($response, 201);
    }

    /**
     * Login Users.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request  $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();
;
        if (!$user || !Hash::check($fields['password'], $user->password)){
            return \response([
                'message' => 'bad creddentials'
            ], 401);
        }

        $token = $user->createToken('bonvoyage_app_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
            'message' => 'succsess'
        ];

        return \response($response, 201);
    }

    /**
     * Login Users.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request  $request)
    {
        auth()->user()->delete();

        return [ 'message' => 'logout' ];
    }

}
