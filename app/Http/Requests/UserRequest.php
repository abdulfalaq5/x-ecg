<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function rules()
    {
        $rule = [];

        if ($this->request->get('update')) {
            $rule['name']          = 'required';
            $rule['email']         = 'required|email|unique:users,email,NULL,id,deleted_at,NULL';
            $rule['phone_number']          = 'required';
            $rule['password'] = 'nullable';
            if ($this->request->get('password') != null) {
                $rule['password'] = 'required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/'; // harus strong password';
            }
        } elseif ($this->method() == 'POST') {
            $rule['name']          = 'required';
            $rule['email']         = 'required|email|unique:users,email,NULL,id,deleted_at,NULL';
            $rule['password']      = 'required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/'; // harus strong password';
            $rule['phone_number']          = 'required';
        }

        return $rule;
    }

    //attributes
    public function attributes()
    {
        return [
            'name'          => 'Nama',
            'email'         => 'Email',
            'password'      => 'Password',
            'phone_number'          => 'Phone Number',
        ];
    }

    //messages

    public function messages()
    {
        return [
            'name.required'     => 'Nama wajib diisi',
            'email.required'    => 'Email wajib diisi',
            'email.email'       => 'Format Email salah',
            'email.unique'      => 'Email is sudah ada',
            'password.required' => 'Password wajib diisi',
            'password.min'      => 'Password paling sedikit 8 karakter',
            'password.regex'    => 'Harus mengandung setidaknya satu angka, satu character dan satu huruf besar dan kecil',
            'phone_number.required'        => 'Phone Number wajib diisi',
            'required'             => ':attribute harus diisi',
            'required_if'          => ':attribute harus diisi',
            'email'                => ':attribute harus berupa email',
            'unique'               => ':attribute sudah terdaftar',
            'min'                  => ':attribute minimal :min karakter',
            'image'                => ':attribute harus berupa gambar',
            'mimes'                => ' :attribute harus berupa gambar dengan format jpg, png, jpeg',
            'max'                  => ':attribute maksimal 2Mb',
        ];
    }
}
