<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct(protected UserService $userService) {}

    

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $authResponse = $this->userService->auth($credentials);

        if ($authResponse->status() === 401) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $authResponse;
    }

}
