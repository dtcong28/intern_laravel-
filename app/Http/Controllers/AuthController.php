<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    protected $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $request->flash();
        $params = $request->all();
        $data = [
            'email' => $params['email'],
            'password' => $params['password']
        ];

        if (Auth::attempt($data, $request->has('remember'))) {
            return redirect('/management/team');
        }

        return redirect()->back()->with('error', config('constants.messages.LOGIN_FAIL'));
    }

    public function logout()
    {
        $this->userRepository->logout();
        return redirect()->route('admin.login');
    }
}
