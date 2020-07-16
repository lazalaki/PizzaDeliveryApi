<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\User;
use Exception;

class UserService {


    public function register($request)
    {
        $user = new User();

        $user->first_name = $request['firstName'];
        $user->last_name = $request['lastName'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);

        try {
            $user->save();
        } catch (QueryException $exception) {            
            throw new Exception("Some information you entered are not valid");
        }

    }


    public function login(array $userData)
    {
        if(auth()->attempt($userData)) {
            $user = auth()->user();
            return response()->json(['user' => $user]);         
        };

        return response()->json(['error' => 'Unauthorized'], 400);        
        
    }

}