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

        $user = $this->userRepository->create($userData);
        return $user;
    }

    public function getWhereNotCurrentUser()
    {
        $userId = Auth::user()->id;
        return $this->userRepository->getWhereNotUserId($userId);
    }

}