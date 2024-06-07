<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function register(RegisterUserRequest $registerUserRequest)
    {
        $user = $this->userService->createUser($registerUserRequest->name, $registerUserRequest->email, $registerUserRequest->password);

        return response()->json([
            'message' => 'User created successfully.',
            'data' => $user,
        ]);
    }

    public function login(UserLoginRequest $userLoginRequest)
    {
        $data = $this->userService->createToken($userLoginRequest->email, $userLoginRequest->password);

        return response()->json([
            'message' => 'User log in successful',
            'data' => $data,
        ]);
    }
}
