<?php

namespace App\Interfaces\Auth;

use App\Http\Requests\Auth\RegisterRequest;

interface AuthInterface
{
    public function register(RegisterRequest $userDetails);
    public function login($userDetails);
}
