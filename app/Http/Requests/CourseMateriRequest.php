<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CourseMateriRequest extends FormRequest
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

        $rule['course_id']          = 'required';
        $rule['star_date']          = 'required';
        $rule['end_date']          = 'nullable';
        $rule['title_materi']          = 'required';
        $rule['status_materi']          = 'required';
        $rule['des_materi']          = 'required';
        if ($this->request->get('file_materi') != 'undifined') {
            $rule['file_materi'] = 'required';
        }

        return $rule;
    }

    //attributes
    public function attributes()
    {
        return [
            'instruktur'          => 'Instruktur',
            'status'         => 'Status',
            'des'      => 'Keterangan',
            'kategori_id'          => 'Kategori',
            'klasifikasi_id'          => 'Klasifikasi',
            'code'          => 'Kode',
            'live'          => 'Live',
            'title'          => 'Title',
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
