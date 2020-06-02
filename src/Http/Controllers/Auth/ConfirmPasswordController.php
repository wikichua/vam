<?php

namespace Wikichua\VAM\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showConfirmForm()
    {
        return view('vam::auth.passwords.confirm');
    }
}
