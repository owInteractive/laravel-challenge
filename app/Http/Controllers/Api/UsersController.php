<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersControllers extends Controller
{
    /**
     * Obter lista de usuarios
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $users = app(User::class)
            ->where('id', '!=', $request->user()->id)
            ->select('id', 'name', 'updated_at')
            ->get();
        //

        return $users->toArray();
    }
}
