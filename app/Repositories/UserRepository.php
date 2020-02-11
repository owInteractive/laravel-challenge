<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getWhereNotUserId($id)
    {
        return $this->get()->where('id', '!=', $id);
    }

    public function getUserByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }
}