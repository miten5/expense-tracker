<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Response;
use Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where("email", $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(["message" => "Invalid credentials"], 401);
        }

        $user->tokens()->delete();

        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "message" => "Login successful",
            "token" => $token,
        ]);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json(["message" => "Logout successful"]);
    }

    public function profile()
    {
        return response()->json(["user" => auth()->user()]);
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:6|confirmed",
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "message" => "Registration successful",
            "token" => $token,
            "user" => $user,
        ]);
    }
}
