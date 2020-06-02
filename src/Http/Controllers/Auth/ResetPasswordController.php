<?php

namespace Wikichua\VAM\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{

    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request, $token = null)
    {
        return view('vam::auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
