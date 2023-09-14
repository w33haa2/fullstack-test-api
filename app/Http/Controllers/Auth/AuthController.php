<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\Auth\RegisterResource;
use App\Interfaces\Auth\AuthInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    private AuthInterface $authRepository;

    public function __construct(AuthInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(RegisterRequest $request): RegisterResource
    {
        return new RegisterResource($this->authRepository->register($request));
    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }

        return new LoginResource($this->authRepository->login($request));
    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        auth('sanctum')->user()->tokens()->delete();
        return response()->json([
            'message' => 'Successfully logged out',
        ], 200);
    }
}
