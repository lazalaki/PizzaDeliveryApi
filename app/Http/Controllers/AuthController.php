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
            return response()->json(['error' => $exception->getMessage()],400);
        }
    }


    public function login(Request $request)
    {
        // try {
        //     $loginResponse = $this->userService->login($request->email, $request->password);
        //     return $loginResponse;
        // } catch (Exception $exception) {
        //     return response()->json(['error' => $exception->getMessage()],400);
        // }

        $credientals = $request->only('password', 'email');

        return $this->userService->login($credientals);
    }


}
