<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
  public $avatar = null;

  public function index()
  {
    $users = User::paginate(8);
    return response()->json($users);
  }

  public function store(Request $request)
  {
    $authController = new AuthController();
    $result = $authController->signup($request);
    return response()->json($result);
  }

  public function show($id)
  {
    $user = User::find($id);
    if ($user === null)
      return response()->json([
        'message' => 'User with this id is unavailable'
      ], 400);
    return response()->json($user, 200);
  }

  public function update(Request $request, $id)
  {
    $user = User::where('id', $id)->first();
    if (empty($user))
      return response()->json([
        'message' => 'User with this id is unavailable'
      ], 400);

    $updates = $request->all();
    if ($request->hasFile('avatar')) {
      $this->validate($request, ['avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',]);
      $file = $request->file('avatar');
      $this->avatar = sha1(Carbon::now()->timestamp) . '.' . $file->getClientOriginalExtension();
      $request->file('avatar')->move("storage", $this->avatar);
      $updates['avatar'] = $this->avatar;
    }
    $user->update($updates);
    $user->save();
    return response()->json($user
      , 201);
  }

  public function ModifyProfile(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $anotheruser = User::where([['email' , $request->get('email')],['id','!=',Auth::user()->id]])->first();
        if(!empty($anotheruser)) return Response()->json(['error' => 'this email alrdy exist'],400); 
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->save();
        return Response()->json($user);
    }

    public function ModifyPassword(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        if(Hash::check($request->get('old_password'),$user->password)){
          $user->password = bcrypt($request->get('password'));
        }else{
          return Response()->json(['error' => 'Wrong Password'],400);
        }
    }

  public function destroy($id)
  {
    $user = User::find($id);
    if (empty($user))
      return response()->json([
        'message' => 'User with this id is unavailable'
      ], 400);
    $user->delete();
    return response()->json([
      'message' => 'User was deleted'
    ], 200);
  }

}
