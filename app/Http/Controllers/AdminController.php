<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModal;
use App\Models\Pengguna;
use App\Models\MateriCourseModal;

class AdminController extends Controller
{
    public function berandaAdmin() 
    {
        $jml_instruktur = Pengguna::where('level', '2')->count();
        $jml_peserta = Pengguna::where('level', '3')->count();
        $jml_kursus = CourseModal::count();
        $jml_materi = MateriCourseModal::count();
        return view('admin.beranda', compact('jml_instruktur', 'jml_peserta', 'jml_kursus', 'jml_materi'));
    }
}
