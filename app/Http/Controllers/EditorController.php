<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\CourseModal;
use App\Models\MateriCourseModal;
use App\Models\ModuleCourseModal;
use App\Models\BankQuizModal;
use App\Models\BankQuizDetailModal;
use App\Models\KontenModal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class EditorController extends Controller
{
    public function berandaEditor() 
    {
        $user = Auth::user();
        $user_id = $user->id;
        $data_course = CourseModal::where('instruktur', $user_id)->get();
        return View('editor.beranda', compact('data_course'));
    }

    public function detailCourse($id)
    {
        $data_course = CourseModal::where('id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();

        return View('editor.detail_course', compact('data_course', 'data_materi', 'data_module', 'id'));
    }

    public function formAddMateri($id)
    {
        $data_course = CourseModal::where('id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();

        return View('editor.add_materi', compact('data_course', 'data_materi', 'data_module', 'id'));
    }

    public function doAddMateri(Request $data)
    {
        DB::beginTransaction();
        try {
            if ($data['file_materi'] != '') {
                $file = $data->file('file_materi');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'file_materi';
                $file->move($tujuan_upload, $nama_file);
            }

            $user             = MateriCourseModal::create([
                'course_id'         => $data['course_id'],
                'star_date'         => $data['star_date'],
                'end_date'         => $data['end_date'],
                'title_materi'         => $data['title_materi'],
                'status_materi'         => $data['status_materi'],
                'des_materi'         => $data['des_materi'],
                'link_video'         => $data['link_video'],
                'file_materi' => $nama_file
            ]);
            DB::commit();
            session()->flash('message', 'Data added successfully');
            return redirect()->route('editor.course.add', $data['course_id']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            session()->flash('error', 'Data added failed');
            return redirect()->route('editor.course.add', $data['course_id']);
        }
    }

    public function editMateri($id, $materi)
    {
        $data_course = CourseModal::where('id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $detail_materi = MateriCourseModal::where('id', $materi)->first();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();

        return View('editor.edit_materi', compact('data_course', 'data_materi', 'data_module', 'id', 'materi', 'detail_materi'));
    }

    public function doeditMateri(Request $data)
    {
        DB::beginTransaction();
        try {
            $getdata = MateriCourseModal::where('id', $data['materi_id'])->first();
            if(!empty($getdata)){
                $getdata->star_date = $data['star_date'];
                $getdata->end_date = $data['end_date'];
                $getdata->title_materi = $data['title_materi'];
                $getdata->status_materi = $data['status_materi'];
                $getdata->des_materi = $data['des_materi'];
                $getdata->link_video = $data['link_video'];

                if ($data['file_materi'] != '') {
                    $file = $data->file('file_materi');
                    $nama_file = time() . "_" . $file->getClientOriginalName();
                    $tujuan_upload = 'file_materi';
                    $file->move($tujuan_upload, $nama_file);
                    $getdata->file_materi = $dnama_file;
                }
                $getdata->save();
            }

            DB::commit();
            session()->flash('message', 'Data update successfully');
            return redirect()->route('editor.course.detail', $data['course_id']);
        } catch (\Throwable $th) {
            DB::rollback();

            session()->flash('error', 'Data update failed');
            return redirect()->route('editor.course.detail', $data['course_id']);
        }
    }

    public function deleteMateri($id)
    {
        $data_materi = MateriCourseModal::where('id', $id)->first();
        $course_id = $data_materi->course_id;
        $data_materi->delete();
        session()->flash('message', 'Data update successfully');
        return redirect()->route('editor.course.detail', $course_id);
    }

    public function formAddModule($id, $materi)
    {
        $data_course = CourseModal::where('id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();

        return View('editor.add_module', compact('data_course', 'data_materi', 'data_module', 'id', 'materi'));
    }

    public function doAddModule(Request $data)
    {
        DB::beginTransaction();
        try {
            if ($data['file_materi'] != '') {
                $file = $data->file('file_materi');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'file_materi';
                $file->move($tujuan_upload, $nama_file);
            }

            $user             = ModuleCourseModal::create([
                'course_id'         => $data['course_id'],
                'materi_id'         => $data['materi_id'],
                'title'         => $data['title'],
                'des'         => $data['des'],
                'link_video'         => $data['link_video'],
                'link_meet'         => $data['link_meet'],
                'file_materi' => $nama_file
            ]);
            DB::commit();
            session()->flash('message', 'Data added successfully');
            return redirect()->route('editor.module.add', [$data['course_id'], $data['materi_id']]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            session()->flash('error', 'Data added failed');
            return redirect()->route('editor.module.add', [$data['course_id'], $data['materi_id']]);
        }
    }

    public function detailModule($id, $materi, $module)
    {
        $data_course = CourseModal::where('id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();

        $detail_module = ModuleCourseModal::where('id', $module)->first();

        return View('editor.detail_module', compact('data_course', 'data_materi', 'data_module', 'id', 'materi', 'module', 'detail_module'));
    }

    public function editModule($id, $module)
    {
        $detail_module = ModuleCourseModal::where('id', $module)->first();
        $data_course = CourseModal::where('id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $detail_materi = MateriCourseModal::where('id', $detail_module->materi_id)->first();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();
        

        return View('editor.edit_module', compact('data_course', 'data_materi', 'data_module', 'id', 'module', 'detail_materi', 'detail_module'));
    }

    public function doeditModule(Request $data)
    {
        DB::beginTransaction();
        try {
            $getdata = ModuleCourseModal::where('id', $data['module_id'])->first();
            if(!empty($getdata)){
                $getdata->title = $data['title'];
                $getdata->des = $data['des'];
                $getdata->link_video = $data['link_video'];
                $getdata->link_meet = $data['link_meet'];

                if ($data['file_materi'] != '') {
                    $file = $data->file('file_materi');
                    $nama_file = time() . "_" . $file->getClientOriginalName();
                    $tujuan_upload = 'file_materi';
                    $file->move($tujuan_upload, $nama_file);
                    $getdata->file_materi = $dnama_file;
                }
                $getdata->save();
            }

            DB::commit();
            session()->flash('message', 'Data update successfully');
            return redirect()->route('editor.course.detail', $data['course_id']);
        } catch (\Throwable $th) {
            DB::rollback();

            session()->flash('error', 'Data update failed');
            return redirect()->route('editor.course.detail', $data['course_id']);
        }
    }

    public function deleteModule($id)
    {
        $data_materi = ModuleCourseModal::where('id', $id)->first();
        $course_id = $data_materi->course_id;
        $data_materi->delete();
        session()->flash('message', 'Data update successfully');
        return redirect()->route('editor.course.detail', $course_id);
    }

    public function quiz($id, $materi, $module)
    {
        $data_course = CourseModal::where('id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();
        $data_quiz = BankQuizModal::where('course_id', $id)->where('materi_id', $materi)->get();

        return View('editor.quiz', compact('data_course', 'data_materi', 'data_module', 'id', 'materi', 'data_quiz', 'module'));
    }

    public function formAddQuiz($id, $materi, $module)
    {
        $data_course = CourseModal::where('id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();

        return View('editor.add_quiz', compact('data_course', 'data_materi', 'data_module', 'id', 'materi', 'module'));
    }

    public function doAddQuiz(Request $data)
    {
        DB::beginTransaction();
        try {
            $user             = BankQuizModal::create([
                'course_id'         => $data['course_id'],
                'materi_id'         => $data['materi_id'],
                'title_quiz'         => $data['title_quiz'],
                'des_quiz'         => $data['des_quiz'],
                'waktu_quiz'         => $data['waktu_quiz'],
                'waktu_akhir_quiz'         => $data['waktu_akhir_quiz']
            ]);
            DB::commit();
            session()->flash('message', 'Data added successfully');
            return redirect()->route('editor.quiz.index', [$data['course_id'], $data['materi_id'], $data['module_id']]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            session()->flash('error', 'Data added failed');
            return redirect()->route('editor.quiz.index', [$data['course_id'], $data['materi_id'], $data['module_id']]);
        }
    }

    public function detailQuiz($quiz, $id, $materi, $module)
    {
        $data_course = CourseModal::where('id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();
        $data_quiz = BankQuizModal::where('id', $quiz)->first();
        $data_quiz_detail = BankQuizDetailModal::where('bank_quiz_id', $quiz)->get();

        return View('editor.detail_quiz', compact('data_course', 'data_materi', 'data_module', 'id', 'materi', 'module', 'data_quiz', 'data_quiz_detail'));
    }

    public function editQuiz($quiz, $id, $materi, $module)
    {
        $data_course = CourseModal::where('id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();
        $data_quiz = BankQuizModal::where('id', $quiz)->first();

        return View('editor.edit_quiz', compact('data_course', 'data_materi', 'data_module', 'id', 'materi', 'module', 'data_quiz'));
    }

    public function doEditQuiz(Request $data)
    {
        DB::beginTransaction();
        try {
            $save = BankQuizModal::where('id', $data['quiz_id'])->first();
            $save->title_quiz = $data['title_quiz'];
            $save->des_quiz = $data['des_quiz'];
            $save->waktu_quiz = $data['waktu_quiz'];
            $save->waktu_akhir_quiz = $data['waktu_akhir_quiz'];
            $save->save();

            DB::commit();
            session()->flash('message', 'Data added successfully');
            return redirect()->route('editor.quiz.index', [$data['course_id'], $data['materi_id'], $data['module_id']]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            session()->flash('error', 'Data added failed');
            return redirect()->route('editor.quiz.index', [$data['course_id'], $data['materi_id'], $data['module_id']]);
        }
    }

    public function deleteQuiz($quiz, $id, $materi, $module)
    {
        $data = BankQuizModal::where('id', $quiz)->first();
        $data->delete();
        session()->flash('message', 'Data update successfully');
        return redirect()->route('editor.quiz.index', [$id, $materi, $module]);
    }

    public function addDetailQuiz($quiz, $id, $materi, $module)
    {
        $data_course = CourseModal::where('id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();
        $data_quiz = BankQuizModal::where('id', $quiz)->first();

        return View('editor.add_detail_quiz', compact('data_course', 'data_materi', 'data_module', 'id', 'materi', 'module', 'quiz', 'data_quiz'));
    }

    public function doAddDetailQuiz(Request $data)
    {
        DB::beginTransaction();
        try {

            $save = new BankQuizDetailModal;
            $save->course_id = $data['course_id'];
            $save->materi_id = $data['materi_id'];
            if(!empty($data['quiz_id'])){
                $save->bank_quiz_id = $data['quiz_id'];
            }
            $save->jenis = $data['jenis'];
            if($data['jenis'] == 1){
                $save->pertanyaan = $data['pertanyaan_1'];
            }elseif($data['jenis'] == 2){
                $save->pertanyaan = $data['pertanyaan_2'];
                $save->jawaban = $data['jawaban_2'];
                $save->option1 = $data['option1'];
                $save->option2 = $data['option2'];
                $save->option3 = $data['option3'];
                $save->option4 = $data['option4'];
            }elseif($data['jenis'] == 3){
                $save->pertanyaan = $data['pertanyaan_3'];
                $save->jawaban = $data['jawaban_3'];
            }else{
                
            }
            $save->bobot_nilai = $data['bobot_nilai'];
            $save->save();

            DB::commit();
            session()->flash('message', 'Data added successfully');
            return redirect()->route('editor.quiz.detail', [$data['quiz_id'], $data['course_id'], $data['materi_id'], $data['module_id']]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            session()->flash('error', 'Data added failed');
            return redirect()->route('editor.quiz.detail', [$data['quiz_id'], $data['course_id'], $data['materi_id'], $data['module_id']]);
        }
    }

    public function importDetailQuiz($quiz, $id, $materi, $module)
    {
        $data_course = CourseModal::where('id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();
        $data_quiz = BankQuizModal::where('id', $quiz)->first();

        return View('editor.import_detail_quiz', compact('data_course', 'data_materi', 'data_module', 'id', 'materi', 'module', 'quiz', 'data_quiz'));
    }

    public function doImportDetailQuiz(Request $data)
    {
        DB::beginTransaction();
        try {

            $path1 = $data->file('file')->store('temp'); 
            $path=storage_path('app').'/'.$path1;  
            $dataImport = Excel::toArray([], $path);

            for ($i = 1; $i <= (count($dataImport[0]) - 1); $i++) {
                if (isset($dataImport[0][$i][0])) {
                    $save = new BankQuizDetailModal;
                    $save->course_id = $data['course_id'];
                    $save->materi_id = $data['materi_id'];
                    if(!empty($data['quiz_id'])){
                        $save->bank_quiz_id = $data['quiz_id'];
                    }
                    $jenis = strtolower($dataImport[0][$i][0]) == 'multiple option' ? 2 : 3;
                    $save->jenis = $jenis;
                    $save->pertanyaan = $dataImport[0][$i][1];
                    $save->option1 = $dataImport[0][$i][2];
                    $save->option2 = $dataImport[0][$i][3];
                    $save->option3 = $dataImport[0][$i][4];
                    $save->option4 = $dataImport[0][$i][5];
                    $save->jawaban = $dataImport[0][$i][6];
                    $save->bobot_nilai = $dataImport[0][$i][7];
                    $save->save();
                }
            }

            DB::commit();
            session()->flash('message', 'Data added successfully');
            return redirect()->route('editor.quiz.detail', [$data['quiz_id'], $data['course_id'], $data['materi_id'], $data['module_id']]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            session()->flash('error', 'Data added failed');
            return redirect()->route('editor.quiz.detail', [$data['quiz_id'], $data['course_id'], $data['materi_id'], $data['module_id']]);
        }
    }

    public function deleteDetailQuiz($detail, $quiz, $id, $materi, $module)
    {
        $data = BankQuizDetailModal::where('id', $detail)->first();
        $data->delete();
        session()->flash('message', 'Data update successfully');
        return redirect()->route('editor.quiz.detail', [$quiz, $id, $materi, $module]);
    }

    public function formKonten($id, $materi, $module)
    {
        $data_course = CourseModal::where('id', $id)->first();
        $data_materi = MateriCourseModal::where('course_id', $id)->get();
        $data_module = ModuleCourseModal::where('course_id', $id)->get();
        $data_konten = KontenModal::where('course_id', $id)->where('materi_id', $materi)->where('module_id', $module)->orderBy('id', 'desc')->first();

        return View('editor.konten', compact('data_course', 'data_materi', 'data_module', 'id', 'materi', 'module', 'data_konten'));
    }

    public function doaddKonten(Request $data)
    {
        DB::beginTransaction();
        try {

            $save = new KontenModal;
            $save->course_id = $data['course_id'];
            $save->materi_id = $data['materi_id'];
            $save->module_id = $data['module_id'];

            if ($data['file'] != '') {
                $file = $data->file('file');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'konten';
                $file->move($tujuan_upload, $nama_file);
                $save->file = $nama_file;
            }

            $save->save();

            DB::commit();
            session()->flash('message', 'Data added successfully');
            return redirect()->route('editor.konten', [$data['course_id'], $data['materi_id'], $data['module_id']]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            session()->flash('error', 'Data added failed');
            return redirect()->route('editor.konten', [$data['course_id'], $data['materi_id'], $data['module_id']]);
        }
    }
}
