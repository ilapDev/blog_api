<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    private AuthService $authService;
    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }
    
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            $result = $this->authService->login($request->all());
            return response()->json($result);    
        } catch (\Exception $e) {
            return  response()->json([
                'message' => $e->getMessage()    
            ], 401);
        }
        
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $result = $this->authService->register(
            $request->all()
        );

        return response()->json($result, 201);
    }

}
