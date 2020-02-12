<?php

namespace App\Business;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserBusiness
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(array $data)
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ];

        return $this->userRepository->create($userData);
    }

    public function getWhereNotCurrentUser()
    {
        $userId = Auth::user()->id;
        return $this->userRepository->getWhereNotUserId($userId);
    }

    public function update(array $data)
    {
        $user = $this->userRepository->getUserByEmail($data['email']);
        $password = $data['new_password'] ?? null;
        if ($password) {
            $data['new_password'] = bcrypt($data['new_password']);
        }
        $this->userRepository->update($user, $data);
        return true;
    }
}
