<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BannerRequest extends FormRequest
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

        $rule['title_banner']          = 'required';
        $rule['des_banner']          = 'required';
        if ($this->request->get('image') != 'undifined') {
            $rule['image'] = 'required|image|mimes:png,jpg,jpe';
        }

        return $rule;
    }

    //attributes
    public function attributes()
    {
        return [
            'title_banner'          => 'Nama Banner',
            'des_banner'         => 'Keterangan Banner',
            'image'      => 'Gambar Banner',
        ];
    }

    //messages

    public function messages()
    {
        return [
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
