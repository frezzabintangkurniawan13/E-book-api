<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return [
            "NIS" => 3103119080,
            "Name" => "Frezza Bintang Kurniawan",
            "Gender" => "Laki-laki",
            "Phone" => 628156805505,
            "Class" => "XII RPL 3"
        ];
    }
//  REGISTER
    public function register(Request $request) {
    $fields = $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|unique:users,email',
        'password' => 'required|string|confirmed'
    ]);
    $user = User::create([
        'name' => $fields['name'],
        'email' => $fields['email'],
        'password' => bcrypt($fields['password'])
    ]);
    $token = $user->createToken('myapptoken')->plainTextToken;
    $response = [
        'user' => $user,
        'token' => $token
    ];
    return response($response, 201);
  }

//  LOGIN
    public function login(Request $request) {
      $fields = $request->validate([
          'email' => 'required|string',
          'password' => 'required|string'
      ]);
      $user = User::where('email', $fields['email'])->first();
      if(!$user || !Hash::check($fields['password'], $user->password)) {
          return response([
              'message' => 'Bad creds'
          ], 401);
      }
      $token = $user->createToken('myapptoken')->plainTextToken;
      $response = [
          'user' => $user,
          'token' => $token
      ];
      return response($response, 201);
  }

//  LOGOUT
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}