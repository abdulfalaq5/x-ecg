<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function formRegister()
    {
        return view('pengguna.form_register');
    }

    public function simpan(Request $req)
    {
        $this->validate($req, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        try {
            $cekByEmail = Pengguna::where('email', $req->input('email'))->first();
            if (empty($cekByEmail)) {
                $datas = $req->all();
                $save = new Pengguna;
                $save->name = $datas['name'];
                $save->username = $datas['email'];
                $save->email = $datas['email'];
                $save->level = 3; //1: admin; 2: instruktur; 3: peserta;
                $save->password = Hash::make($datas['password']);
                $save->phone_number = $req->input('phone_number');
                $save->save();

                $msg = [
                    'status' => true,
                    'msg' => 'sukses'
                ];
            }else{
                $msg = [
                    'status' => false,
                    'msg' => 'email sudah pernah terdaftar'
                ];
            }
            return $msg;
        } catch (\Throwable $th) {
            $msg = [
                'status' => false,
                'msg' => 'terjadi kesalahan di server'
            ];
            return $msg;
        }
    }
}
