<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function register(RegisterRequest $request)
    {
        try {
            $this->userService->register($request);
            return response()->json([], 201);
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()],400);
        }
    }


    public function login(Request $request)
    {
        try {
            $credientals = $request->only('password', 'email');
            $loginResponse = $this->userService->login($credientals);
            return $loginResponse;
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()],400);
        }

    }


}
