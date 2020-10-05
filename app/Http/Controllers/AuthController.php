<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{
  public $avatar = null;

  public function signup(Request $request)
  {
    $request->validate([
      'name' => 'required|string',
      'email' => 'required|string|email|unique:users',
      'password' => 'required|string|confirmed',
    ]);

    // validation is done
    if ($request->hasFile('avatar')) {
      $this->validate($request, ['avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',]);
      $file = $request->file('avatar');
      $this->avatar = sha1(Carbon::now()->timestamp) . '.' . $file->getClientOriginalExtension();
      $request->file('avatar')->move("storage", $this->avatar);
    }
    $user = new User([
      'name' => $request->name,
      'email' => $request->email,
      'avatar' => empty($this->avatar) ? "/img/placeholder.jpg" : $this->avatar,
      'password' => bcrypt($request->password),
    ]);

    $user->save();
    return $this->signin($request);
  }

  public function signin(Request $request)
  {
    $request->validate([
      'email' => 'required|string|email',
      'password' => 'required|string',
      'remember_me' => 'boolean'
    ]);

    $credentials = request(['email', 'password']);

    if (!Auth::attempt($credentials))
      return response()->json([
        'message' => 'Unauthorized'
      ], 400);

    $user = $request->user();

    $tokenResult = $user->createToken('Personal Access Token');

    $token = $tokenResult->token;

    if ($request->remember_me)
      $token->expires_at = Carbon::now()->addWeeks(1);
    $token->save();

    return response()->json([
      'user' => $user,
      'access_token' => $tokenResult->accessToken,
      'token_type' => 'Bearer',
      'expires_at' => Carbon::parse(
        $tokenResult->token->expires_at
      )->toDateTimeString()
    ]);
  }

  public function user(Request $request)
  {
    $user_id = $request->user()->id;
    $user = User::where('id', $user_id)
      ->first();
    return response()->json($user);
  }

  public function logout(Request $request)
  {
    $request->user()->token()->revoke();
    $request->user()->save();
    return response()->json([
      'message' => 'Successfully logged out'
    ]);
  }

  public function forgot(Request $request){
    $email = $request->get('email');
    if(User::where('email',$email)->doesntExist())
      return response()->json([
        'error' => 'user doesn\'t exists'
      ],404);
      $token = Str::random(10);
      try{
        DB::table('password_resets')->insert([
        'email'=>$email,
        'token' =>$token
      ]);


      Mail::send('Mails.forgot',['token'=>$token], function($message) use($email){
        $message->to($email);
        $message->subject('Reset password');
      });


      return response()->json([
        'message' => 'check your email'
      ]);
    }catch(\Exception $e){
      return response()->json([
        'message' => $e->getMessage()
      ],400);
    }
      //Send Email and catche it with mailcatcher


  }
}