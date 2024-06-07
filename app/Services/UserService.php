<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(string $name, string $email, string $password)
    {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return $user;
    }

    public function createToken(string $email, string $password)
    {
        $user = User::where('email', $email)->first();
        if (is_null($user) || !auth()->attempt(['email' => $email, 'password' => $password])) {
            throw new \Exception('Invalid login credentials');
        }

        $token = $user->createToken('API token');

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function getUsers() {
        return User::all();
    }
}
