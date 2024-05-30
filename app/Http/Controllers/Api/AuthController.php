<?php

namespace App\Http\Controllers\Api;

use App\Models\UserCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:users_customer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users_customer'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = UserCustomer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'kode' => 400,
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $credentials = $request->only('email', 'password');
        dd($credentials);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'kode' => 200,
                'status' => true,
                'user' => $user,
                'token' => $token,
            ], 200);
        } else {
            return response()->json([
                'kode' => 401,
                'status' => false,
                'message' => 'Maaf, Akun Anda Tidak Ditemukan',
            ], 401);
        }
        
    }
    /**
     * Handle an incoming logout request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'kode' => 200,
            'status' => true,
            'message' => 'Logged out successfully',
        ], 200);
    }
}
