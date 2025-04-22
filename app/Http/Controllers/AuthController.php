<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
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
                $user = Vendor::with([])
                    ->where('email', '=', $email)
                    ->first();


                if (!$user) {
                    return redirect()->back()->with('failed', 'email pengguna tidak ditemukan...')->withInput();
                }

                $isPasswordValid = Hash::check($password, $user->password);
                if (!$isPasswordValid) {
                    return redirect()->back()->with('failed', 'password tidak cocok...')->withInput();
                }
                Auth::loginUsingId($user->id);
                $now = Carbon::now()->format('Y-m-d H:i:s');
                Vendor::with([])
                    ->where('id', '=', auth()->id())
                    ->update([
                        'last_seen' => $now
                    ]);
                return redirect()->back()->with('success', 'Berhasil');
            } catch (\Exception $e) {
                return redirect()->back()->with('failed', 'Terjadi kesalahan server... ' + $e)->withInput();
            }
        }
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
