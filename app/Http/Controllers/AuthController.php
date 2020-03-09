<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestAuthController;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    function register (RequestAuthController $request)
    {
        $teste = User::create(
            ['name'=>$request['name'],
                'email'=>$request['email'],
                'password'=>bcrypt($request['password'])
            ]);

        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'E-mail ou senha inválidos',
            ], 401);
        }
        return response()->json(
            [
                'user'=>['name'=>$request['name'],'email'=>$request['email']],
                'credencials' =>['token'=>$token,'expires_in' => JWTAuth::factory()->getTTL() * 60],
                'redirect'=>'http://localhost:8000/home-app'
            ],200);

    }
    function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|string'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'Usuário desconectado com sucesso',
                'redirect'=>'http://localhost:8000/login'
            ],200);
        } catch (JWTException $exception) {

            return response()->json([
                'success' => false,
                'message' => 'Desculpe, nao e possevel desconectar o usuario',
                'redirect'=>false
            ], 500);
        }
    }

}