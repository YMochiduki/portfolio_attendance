<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = 'attendance';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function loggedOut(Request $request)
    {
        // ログイン画面にリダイレクト
        return redirect(route('login'));
    }
}
