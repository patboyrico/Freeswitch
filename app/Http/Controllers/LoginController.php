<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('admin.guest', ['except' => 'logout']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {

    }

    protected function guard()
    {
        return Auth::guard('admin');
    }


}
