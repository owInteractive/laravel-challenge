<?php

namespace App\Http\Controllers;

use App\Business\UserBusiness;
use App\Http\Requests\ProfileChangePasswordFormRequest;
use App\Http\Requests\ProfileUpdateFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $userBusiness;

    public function __construct(UserBusiness $userBusiness)
    {
        $this->userBusiness = $userBusiness;
    }

    public function index()
    {
        return view('profiles.index');
    }

    public function update(ProfileUpdateFormRequest $request)
    {
        $this->userBusiness->update($request->all());
        return redirect('profile/index');
    }

    public function changePassword(ProfileChangePasswordFormRequest $request)
    {
        $user = Auth::user();
        $currentPassword = $request->get('current_password');
        if (!(Hash::check($currentPassword, $user->password))) {
            info("aqui");
            return redirect('profile/index')
                ->withErrors(['Your current password must match with the password you provide.']);
        }

        $this->userBusiness->update($request->all());
        return redirect('profile/index');
    }

}