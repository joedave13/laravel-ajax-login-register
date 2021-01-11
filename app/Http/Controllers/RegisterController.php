<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Register berhasil!'
            ], 201);
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Register gagal!'
            ], 400);
        }
    }
}
