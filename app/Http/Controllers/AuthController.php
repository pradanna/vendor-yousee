<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    private $rule = [
        'email' => 'required|email',
        'password' => 'required|min:8'
    ];

    private $message = [
        'email.required' => 'kolom email wajib di isi',
        'email.email' => 'alamat email tidak valid',
        'password.required' => 'kolom password wajib di isi',
        'password.min' => 'kolom password minimal 8 karakter',
    ];

    public function login()
    {
        if (\request()->method() === 'POST') {
            try {
                $validator = Validator::make(\request()->all(), $this->rule, $this->message);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $email = \request()->request->get('email');
                $password = \request()->request->get('password');
                
            }catch (\Exception $e) {

            }
        }
        return view('auth.login');
    }
}
