<?php

namespace App\Repositories\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Interfaces\Auth\AuthInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthInterface
{
    public function login($userDetails)
    {

        $user = User::where('email', $userDetails->email)->first();
        $user->access_token = $user->createToken($user->name)->plainTextToken;
        return $user;
    }

    public function register(RegisterRequest $userDetails)
    {
        return User::create([
            'name' => $userDetails['name'],
            'email' => $userDetails['email'],
            'password' => Hash::make($userDetails['password'])
        ]);
    }
}
