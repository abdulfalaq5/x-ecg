<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModal;
use Illuminate\Support\Facades\Auth;
use App\Models\TestimoniCourseModal;
use App\Models\MateriCourseModal;
use App\Models\ModuleCourseModal;
use App\Models\MyCourseModal;
use Illuminate\Support\Facades\DB;
use App\Models\BankQuizModal;
use App\Models\BankQuizDetailModal;
use App\Models\JawabModal;

class PesertaController extends Controller
{
    public function berandaPeserta()
    {
        return view('peserta.beranda');
    }

    public function mycourseList()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $data_course = CourseModal::select(
            
            'course.id',
            'course.instruktur',
            'course.title',
            'course.des',
            'course.cover',
            'course.created_at'
        )
            ->join('mycourses', 'mycourses.course_id', '=', 'course.id')
            ->where('mycourses.peserta_id', $user_id)
            ->get();
        
        $jml_data = count($data_course);
        if ($jml_data == 0) {
            return View('peserta.my-courses');
        } else {
            return View('peserta.my-have-courses', compact('data_course', 'jml_data'));
        }
    }

    public function courseList()
    {
        $testimoni_course = TestimoniCourseModal::select(DB::raw("GROUP_CONCAT(testimoni_course.course_id SEPARATOR ',') AS group_course_id"))->where('nilai', '>=', '7')->groupBy('testimoni_course.course_id')->limit('6')->get();
        if (!empty($testimoni_course->group_course_id) && $testimoni_course->group_course_id != '') {
            $testimoni_course = explode(',', $testimoni_course->group_course_id);
            $data_course_popular = CourseModal::select(
                
                'course.id',
                'course.instruktur',
                'course.title',
                'course.des',
                'course.cover',
                'course.created_at'
            )
                ->join('mycourses', 'mycourses.course_id', '=', 'course.id')
                ->whereIn('course_id', $testimoni_course)
                ->get();
            $data_course_normal = CourseModal::select(
                
                'course.id',
                'course.instruktur',
                'course.title',
                'course.des',
                'course.cover',
                'course.created_at'
            )
            ->whereNotIn('course_id', $testimoni_course)
                ->get();
        } else {
            $data_course_popular = [];
            $data_course_normal = CourseModal::select(
                
                'course.id',
                'course.instruktur',
                'course.title',
                'course.des',
                'course.cover',
                'course.created_at'
            )
                ->get();
        }

        return View('peserta.my-home-courses', compact('data_course_popular', 'data_course_normal'));
    }

    public function option(Request $request)
    {
        $data = $this->getOption($request->search);
        $list     = [];
        foreach ($data as $key => $row) {
            $list[$key]['id']   = $row->id;
            $list[$key]['text'] = $row->name;
        }

        return json_encode($list);
    }

    public function getOption($search = null, $id = null)
    {
        $datas    = CourseModal::select('id', 'name')
            ->whereNull('rooms.deleted_at');

        if ($search != null) {
            $datas = $datas->where('name', 'like', "%{$search}%");
        }
        if ($id != null) {
            $datas = $datas->where('id', '=', "{$id}");
        }
        $datas = $datas->orderBy('name', 'asc');

        return $datas->get();
    }

    public function courseDetail($id)
    {
        /**
         * kl ada datanya by peserta id maka masuk ke detail pembelajara
         * jika tidak ada maka masuknya ke detail pembayaran
         */
        $user = Auth::user();
        $peserta_id = $user->id;

        //cek datanya by peserta id ke mycourse
        $cek_my_course = MyCourseModal::where('peserta_id', $peserta_id)->where('course_id', $id)->first();
        if(!empty($cek_my_course)){
            $data_course = CourseModal::select('title', 'des', 'code', 'cover', 'waktu_per_minggu', 'name')
            ->join('pengguna', 'course.instruktur', '=', 'pengguna.id')
            ->where('course.id', $id)->first();
            $data_materi = MateriCourseModal::where('course_id', $id)->get();
            $data_module = ModuleCourseModal::where('course_id', $id)->get();
            return View('peserta.my-detail-courses', compact('data_course', 'data_materi', 'data_module', 'id'));
        }else{
            $data_course = CourseModal::select('title', 'des', 'code', 'cover', 'waktu_per_minggu', 'name', 'harga', 'income')
            ->join('pengguna', 'course.instruktur', '=', 'pengguna.id')
            ->where('course.id', $id)->first();
            $data_materi = MateriCourseModal::where('course_id', $id)->get();
            $data_module = ModuleCourseModal::where('course_id', $id)->get();
            return View('peserta.payment-detail', compact('data_course', 'data_materi', 'data_module', 'id'));
        }
    }

    public function detailModule($id, $materi, $module)
    {
        $data_course = CourseModal::where('id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();

        $detail_module = ModuleCourseModal::where('id', $module)->first();

        return View('peserta.detail_module', compact('data_course', 'data_materi', 'data_module', 'id', 'materi', 'module', 'detail_module'));
    }

    public function courseDetailConten($id)
    {
        $data_course = CourseModal::select('title', 'des', 'code', 'cover', 'waktu_per_minggu', 'name')
        ->join('pengguna', 'course.instruktur', '=', 'pengguna.id')
        ->where('course.id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();
        return View('peserta.my-detail-konten-courses', compact('data_course', 'data_materi', 'data_module', 'id'));
    }

    public function courseDetailQuiz($id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $data_course = CourseModal::select('title', 'des', 'code', 'cover', 'waktu_per_minggu', 'name')
        ->join('pengguna', 'course.instruktur', '=', 'pengguna.id')
        ->where('course.id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();
        $data_quiz = BankQuizModal::select('bank_quiz.id as bank_quiz_id', 'materi_course.id as materi_course_id', 'materi_course.title_materi', 'bank_quiz.title_quiz')
        ->join('materi_course', 'materi_course.id', '=', 'bank_quiz.materi_id')
        ->join('mycourses', 'mycourses.course_id', '=', 'materi_course.course_id')
        ->where('bank_quiz.course_id', $id)
        ->where('mycourses.peserta_id', $user_id)
        ->get();
        return View('peserta.kuis', compact('data_course', 'data_materi', 'data_module', 'data_quiz', 'id'));
    }

    public function quiz($quiz, $id, $materi)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $data_course = CourseModal::select('title', 'des', 'code', 'cover', 'waktu_per_minggu', 'name')
        ->join('pengguna', 'course.instruktur', '=', 'pengguna.id')
        ->where('course.id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();
        $data_quiz = BankQuizModal::where('course_id', $id)->where('materi_id', $materi)->first();

        $get_quis_yg_sudah_dikerjakan = JawabModal::where('peserta_id', $user_id)->where('course_id', $id)->where('materi_id', $materi)->get();
        $data_jawab = "";
        $data_nilai = 0;
        if(!empty($get_quis_yg_sudah_dikerjakan)){
            foreach ($get_quis_yg_sudah_dikerjakan as $d => $row) {
                $data_jawab .= $row->quiz_detail_id . ',';
                $data_nilai += $row->nilai;
            }
        }

        $data_jawab_value = explode(",", $data_jawab);

        $data_quiz_detail = BankQuizDetailModal::where('bank_quiz_id', $quiz)->whereNotIn('id', $data_jawab_value)->orderBy('bank_quiz_id', 'desc')->first();

        $data_presentase = BankQuizDetailModal::where('bank_quiz_id', $quiz)->get();
        $jml_quiz = 0;
        $jml_selesai = 1;
        $jml_belum_selesai = 0;
        $no=0;
        foreach ($data_presentase as $key => $value) {
            if($value->status == 1){
                $jml_selesai += 1;
            }
            if($value->status != 1){
                $jml_belum_selesai += 1;
            }
            $jml_quiz += 1;
            $no += 1;
        }
        $presentasi_sudah = ($jml_selesai / $jml_quiz) * 100;

        if(empty($data_quiz_detail)){
            return View('peserta.kuis-rating', compact('data_course', 'data_materi', 'data_module', 'id', 'data_quiz', 'data_quiz_detail', 'presentasi_sudah', 'no', 'materi', 'data_nilai'));
        }else{
            return View('peserta.kuis-soal', compact('data_course', 'data_materi', 'data_module', 'id', 'data_quiz', 'data_quiz_detail', 'presentasi_sudah', 'no', 'materi'));
        }
        
    }

    public function simpanQuiz(Request $data)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $course_id = $data['course_id'];
        $materi_id = $data['materi_id'];
        $quiz_detail_id = $data['quiz_detail_id'];
        $peserta_id = $user_id;
        $jawaban = $data['jawaban'];
        $jenis = $data['jenis'];

        $get_jawaban = BankQuizDetailModal::where('id', $quiz_detail_id)->first();
        if($jenis == 2){
            if($get_jawaban->jawaban == $jawaban){
                $nilai = $get_jawaban->bobot_nilai;
            }else{
                $nilai = 0;
            }
        }else{
            if($get_jawaban->jawaban == true || $get_jawaban->jawaban == "true" || $get_jawaban->jawaban == 1){
                $regjawaban = 'BENAR';
            }else{
                $regjawaban = 'SALAH';
            }
            if($regjawaban == $jawaban){
                $nilai = $get_jawaban->bobot_nilai;
            }else{
                $nilai = 0;
            }
        }

        JawabModal::create([
            'course_id'         => $data['course_id'],
            'materi_id'         => $data['materi_id'],
            'quiz_detail_id'         => $data['quiz_detail_id'],
            'peserta_id'         => $peserta_id,
            'jawab'         => $data['jawaban'],
            'nilai'         => $nilai
        ]);

        $get_jawaban->status = 1;
        $get_jawaban->save();

        return redirect()->route('peserta.quiz.index', [$get_jawaban->bank_quiz_id, $course_id, $materi_id]);
    }

    public function getSertifikat($id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $data_course = CourseModal::select('title', 'des', 'code', 'cover', 'waktu_per_minggu', 'name')
        ->join('pengguna', 'course.instruktur', '=', 'pengguna.id')
        ->where('course.id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();

        return View('peserta.sertifikat', compact('data_course', 'data_materi', 'data_module', 'id'));
    }

    public function cetakSertifikat()
    {
        return View('peserta.sertifikat-view');
    }
}
