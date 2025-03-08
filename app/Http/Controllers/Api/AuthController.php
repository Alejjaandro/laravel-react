<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request) {
        $response = [
            'status' => 'error',
            'message' => 'Validation error',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            return response()->json($response, 422);
        }

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        $user->assignRole('client');

        $response['status'] = 'success';
        $response['message'] = 'User created successfully';
        $response['token'] = $user->createToken('auth_token')->plainTextToken;

        return response()->json($response, 201);
    }

    public function login(Request $request) {
        $response = [
            'status' => 'error',
            'message' => 'Validation error',
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            return response()->json($response, 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            $response['message'] = 'Invalid credentials';
            return response()->json($response, 401);
        }

        $user->hasRole('client');

        $response['status'] = 'success';
        $response['message'] = 'User logged in successfully';
        $response['token'] = $user->createToken('auth_token')->plainTextToken;
        $response['user'] = $user;

        return response()->json($response, 200);
    }

    public function logout(Request $request) {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Token revoked',
        ], 200);
    }
}
