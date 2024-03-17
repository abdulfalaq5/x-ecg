<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Str;
use App\Models\passwordResetToken;
use App\Mail\LupaPasswordMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LupaPasswordController extends Controller
{
    public function formLupaPassword()
    {
        return view('pengguna.form_lupa_password');
    }

    public function prosesLupaPassword(Request $req)
    {
        //validasi input
        $this->validate($req, [
            'email' => 'required|string|email'
        ]);

        try {
            $datas = $req->all();
            //validasi email
            $cek_email = Pengguna::where('email', $datas['email'])->first();
            if (empty($cek_email)) {
                session()->flash('error', 'Email tidak ditemukan');
                return redirect()->route('forgot.form-forgot');
            }

            //pembuatan token
            $token = Str::random(54);

            //simpan token
            $save_token = new passwordResetToken;
            $save_token->email = $datas['email'];
            $save_token->token = $token;
            $save_token->created_at = date('Y-m-d H:i:s');
            $save_token->save();

            //kirim email reset password
            $data_email = [
                'nama_pengguna' => $cek_email->name,
                'url_reset' => env('APP_URL') . '/forgot/reset-password/' . $token,
            ];

            Mail::to($datas['email'])->send(new LupaPasswordMail($data_email));

            session()->flash('message', 'Silahkan Periksa Email Anda');
            return redirect()->route('forgot.form-forgot');
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
            //session()->flash('error', 'Reset password gagal');
            return redirect()->route('forgot.form-forgot');
        }
    }

    public function resetPassword($token)
    {
        //cek data by token
        $dataReset = passwordResetToken::where('token', $token)->first();
        if (empty($dataReset)) {
            session()->flash('error', 'Token tidak valid');
            return redirect()->route('forgot.form-forgot');
        }
        $token = $token;
        $email = $dataReset->email;

        //proses menampilkan form reset password
        return view('pengguna.form_atur_ulang_password', compact('email', 'token'));
    }

    public function prosesResetPassword(Request $req)
    {
        //validasi password baru
        $this->validate($req, [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $datas = $req->all();
            //validasi email
            $cek_email = Pengguna::where('email', $datas['email'])->first();
            if (empty($cek_email)) {
                session()->flash('error', 'Email tidak ditemukan');
                return redirect()->route('forgot.form-forgot');
            }
            
            //proses update password
            Pengguna::where('email', $datas['email'])->update([
                'password' => Hash::make($datas['password'])
            ]);

            //proses hapus ke tabel reset password by email
            passwordResetToken::where('email', $datas['email'])->delete();

            session()->flash('message', 'Reset password sukses');
            return redirect()->route('login.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Token tidak valid');
            return redirect()->route('forgot.form-forgot');
        }
    }
}
