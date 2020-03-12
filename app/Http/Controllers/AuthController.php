<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestAuthController;
use App\Http\Requests\RequestUserUpdate;
use App\Http\Requests\RequestAuthControllerUpdateLogin ;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    function register (RequestAuthController $request)
    {
         User::create(
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
                'redirect'=>url('home-app')
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
                'redirect'=>url('login')
            ],200);
        } catch (JWTException $exception) {

            return response()->json([
                'success' => false,
                'message' => 'Desculpe, nao e possevel desconectar o usuario',
                'redirect'=>false
            ], 500);
        }
    }
    function login(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|string',
            'password'=>'required|string'
        ]);

        if (!$token = JWTAuth::attempt($request->only('email','password'))) {
            return response()->json([
                'success' => false,
                'message' => 'E-mail ou senha inválidos',
                'redirect'=>false
            ], 401);
        }

      $user = auth()->user();
      return response()->json([
          'user'=>['name'=>$user->name,'email'=>$user->email],
          'credencials' =>['token'=>$token,'expires_in' => JWTAuth::factory()->getTTL() * 60],
          'redirect'=>url('home-app')

      ]);

    }
    public function updateUser(RequestAuthControllerUpdateLogin $request, $id)
    {

        $crud = User::findOrFail($id);
        $crud->name      = $request->name;
        $crud->email     = $request->email;
        ($request->password)?$crud->password  = bcrypt($request->password):'';
        if($crud->save()){
            return response()->json([
              'status'=>true,
              'msg'=>'Registro atualizado com sucesso!',
              'user'=>['name'=>$crud->name,'email'=>$crud->email]
            ]);

        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'Erro ao atualizar registro! \n Tente novamente mais tarde.'
              ]);
            }


    }

}