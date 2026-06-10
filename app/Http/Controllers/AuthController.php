<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek kecocokan data
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Generate token 
            $token = $user->createToken('API-TOKEN')->plainTextToken;

            // Respon sukses [cite: 57, 58, 59]
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ], 200);
        }

        // Respon error [cite: 63, 64]
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized'
        ], 401);
    }
}