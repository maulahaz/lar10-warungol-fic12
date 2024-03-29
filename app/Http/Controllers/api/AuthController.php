<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // return response()->json('test1');
        // die();
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'email|required|unique:users',
            'phone' => 'required',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => Hash::make($validatedData['password']),
            'roles' => 'user'
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'user' => UserResource::make($user),
        ]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $user = User::where('email', $loginData['email'])->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 401);
        }

        if (!Hash::check($loginData['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => UserResource::make($user),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout success'
        ]);
    }

    //--Update fcm_id:
    public function updateFcmId(Request $request)
    {
        $validatedData = $request->validate([
            'fcm_id' => 'required',
        ]);

        $user = Auth::user();
        $user->fcm_id = $validatedData['fcm_id'];
        $user->save();
        return response()->json([
            'message' => 'Update success'
        ]);
    }
}