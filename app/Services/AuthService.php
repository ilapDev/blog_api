<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService {
     public function login(array $data) {
        $user = User::where('email', $data['email'])->first();
        if (!$user) {
            throw new \Exception('User not found');
        }

        if(!Hash::check($data['password'], $user->password)) {
            throw new \Exception('Wrong password');
        }

        $token = $user->createToken('api-token')->plainTextToken;
        return [
            'user' => $user,
            'access_token' => $token
        ];
    }
    public function register(array $data) {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 2
            ]);

        return [
            'user' => $user
        ];
    }

   
}