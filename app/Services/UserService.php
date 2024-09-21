<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(protected User $user) {}

    public function fetchUsers()
    {
        return $this->user->select(['id', 'name', 'email'])->latest()->get();
    }

    public function create(array $data)
    {
        return $this->user->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),            
        ]);
    }

    public function update(array $data, $id)
    {
        $user = $this->user->findOrFail($id);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $user->update($data);
    }

    public function delete($id)
    {
        $user = $this->user->findOrFail($id);
        $user->delete($id);
    }

    public function find($id)
    {
        return $this->user->select(['id', 'name', 'email'])->findOrFail($id);
    }

    public function auth(array $credentials)
    {
        $user = $this->user->where('email', $credentials['email'])->first();
        
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response([
                'msg' => 'Unauthorized'
            ], 401);
        }

        $token = $user->createToken('ApiToken')->plainTextToken;
        return response()->json([
            'user' => $user->select('id', 'name', 'email'),
            'token' => $token
        ]);
    }

}