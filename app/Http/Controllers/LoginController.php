<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function formLogin()
    {
        return view('pengguna.form_login');
    }

    public function prosesLogin(Request $req)
    {
        $this->validate($req, [
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            $kredential = $req->only('username', 'password');
            if (Auth::attempt($kredential)) {
                $user = Auth::user();
                return $user->level;
               /* if ($user->level == '1') { //1: admin; 2: instruktur; 3: peserta;
                   return redirect()->intended('admin');
                } elseif ($user->level == '2') {
                    return redirect()->intended('editor');
                } elseif ($user->level == '3') {
                    return redirect()->intended('peserta');
                } else {
                    return redirect()->intended('/');
                }*/
            } else {
                return false;
                //session()->flash('error', 'gagal login');
               // return redirect()->route('login.index');
            }
        } catch (\Throwable $th) {
            //session()->flash('error', 'gagal login');
            return false;
            //return redirect()->route('login.index');
        }
    }
}
