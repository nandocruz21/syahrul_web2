<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('API-TOKEN')->plainTextToken; [cite: 175]

            return response()->json([
                'success' => true, [cite: 57]
                'message' => 'Login berhasil', [cite: 58]
                'data' => [ [cite: 59]
                    'user' => $user,
                    'token' => $token
                ]
            ], 200);
        }

        return response()->json([
            'success' => false, [cite: 63]
            'message' => 'Unauthorized' [cite: 64]
        ], 401);
    }
}