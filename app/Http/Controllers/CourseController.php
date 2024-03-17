<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModal;
use App\Models\KategoriModal;
use App\Models\KlasifikasiModal;
use App\Models\Pengguna;
use App\Models\MateriCourseModal;
use App\Models\BankQuizModal;
use App\Models\BankQuizDetailModal;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CourseListRequest;
use App\Http\Requests\CourseMateriRequest;


class CourseController extends Controller
{
    public function listIndex()
    {
        return view('admin.courses.list.index');
    }

    public function listList(Request $request)
    {
        $datatables = datatables($this->allList($request));

        return $datatables
            //index
            ->addIndexColumn()
            //action
            ->addColumn('action', function ($row) {
                $html = '';
                $html .= '<a href="' . route('courses.list.edit', $row->_token) . '" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></a>';

                $id = $row->_token;
                $html .= ' &nbsp;<a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteData(' . "'$id'" . ',' . "'$row->name'" . ')"><i class="fa fa-trash"></i></a>';

                $html .= ' &nbsp;<a href="' . route('courses.list.view', $row->_token) . '" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>';

                return $html;
            })
            //filter
            ->filter(function ($query) use ($request) {
                if ($request->search) {
                    $query->where(
                        function ($q) use ($request) {
                            $q->where('course.title', 'like', '%' . $request->search . '%')
                                ->orWhere('course.instruktur', 'like', '%' . $request->search . '%')
                                ->orWhere('kategori.kategori_name', 'like', '%' . $request->search . '%')
                                ->orWhere('klasifikasi.klasifikasi_name', 'like', '%' . $request->search . '%');
                        },
                    );
                }
            })

            ->escapeColumns([])->toJson();
    }

    public function allList($request)
    {
        $filter    = $request['filter'];
        $searchVal = (isset($filter['search'])) ? $filter['search'] : false;

        $data = CourseModal::select([
            DB::raw("md5(concat(course.id,'-',date_format(curdate(), '%Y%m%d'))) as _token"),
            'course.id',
            'course.code',
            'course.title',
            'kategori.kategori_name',
            'klasifikasi.klasifikasi_name',
            'course.live',
            'course.status',
            DB::raw('(select count(*) from mycourses where mycourses.course_id=course.id group by course_id) as peserta'),
            'course.created_at',
            'course.harga',
        ])
            ->leftJoin('kategori', 'kategori.id', 'course.kategori_id')
            ->leftJoin('klasifikasi', 'klasifikasi.id', 'course.klasifikasi_id')
            ->when($searchVal, function ($query) use ($searchVal) {
                $query->where('course.code', 'like', "%{$searchVal}%")
                    ->orWhere('course.title', 'like', "%{$searchVal}%")
                    ->orWhere('course.live', 'like', "%{$searchVal}%")
                    ->orWhere('course.status', 'like', "%{$searchVal}%")
                    ->orWhere('kategori.kategori_name', 'like', "%{$searchVal}%")
                    ->orWhere('klasifikasi.klasifikasi_name', 'like', "%{$searchVal}%");
            });

        return $data;
    }

    public function listCreate(Request $request)
    {
        return view('admin.courses.list.create');
    }

    public function listDoCreate(CourseListRequest $data)
    {
        DB::beginTransaction();
        try {
            if ($data['cover'] != 'undifined') {
                $file = $data->file('cover');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'cover';
                $file->move($tujuan_upload, $nama_file);
            }

            $user             = CourseModal::create([
                'code'         => $data['code'],
                'kategori_id'         => $data['kategori_id'],
                'klasifikasi_id'         => $data['klasifikasi_id'],
                'instruktur'         => $data['instruktur'],
                'title'         => $data['title'],
                'status'         => $data['status'],
                'live'         => $data['live'],
                'des'         => $data['des'],
                'waktu_per_minggu'         => $data['waktu_per_minggu'],
                'harga'         => $data['harga'],
                'income'         => $data['income'],
                'cover' => $nama_file
            ]);
            DB::commit();
            return jsonSuccess('Data berhasil di buat');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            return jsonError($th->getMessage());
        }
    }

    public function optionKatgeori(Request $request)
    {
        $users = $this->getOptionKatgeori($request->search);
        $list     = [];
        foreach ($users as $key => $row) {
            $list[$key]['id']   = $row->id;
            $list[$key]['text'] = $row->kategori_name;
        }

        if ($request->all == true) {
            $newElement = [
                'id'   => 0,
                'text' => 'All',
            ];
            array_unshift($list, $newElement);
        }

        return json_encode($list);
    }

    public function getOptionKatgeori($search = null, $id = null)
    {
        $datas    = KategoriModal::select('id', 'kategori_name')
            ->whereNull('kategori.deleted_at');

        if ($search != null) {
            $datas = $datas->where('kategori_name', 'like', "%{$search}%");
        }
        if ($id != null) {
            $datas = $datas->where('id', '=', "{$id}");
        }
        $datas = $datas->orderBy('kategori_name', 'asc');

        return $datas->get();
    }

    public function optionKlasifikasi(Request $request)
    {
        $users = $this->getOptionKlasifikasi($request->search);
        $list     = [];
        foreach ($users as $key => $row) {
            $list[$key]['id']   = $row->id;
            $list[$key]['text'] = $row->klasifikasi_name;
        }

        if ($request->all == true) {
            $newElement = [
                'id'   => 0,
                'text' => 'All',
            ];
            array_unshift($list, $newElement);
        }


        return json_encode($list);
    }

    public function getOptionKlasifikasi($search = null, $id = null)
    {
        $datas    = KlasifikasiModal::select('id', 'klasifikasi_name')
            ->whereNull('klasifikasi.deleted_at');

        if ($search != null) {
            $datas = $datas->where('klasifikasi_name', 'like', "%{$search}%");
        }
        if ($id != null) {
            $datas = $datas->where('id', '=', "{$id}");
        }
        $datas = $datas->orderBy('klasifikasi_name', 'asc');

        return $datas->get();
    }

    public function optionInstruktur(Request $request)
    {
        $users = $this->getOptionIntruktur($request->search);
        $list     = [];
        foreach ($users as $key => $row) {
            $list[$key]['id']   = $row->id;
            $list[$key]['text'] = $row->name;
        }

        if ($request->all == true) {
            $newElement = [
                'id'   => 0,
                'text' => 'All',
            ];
            array_unshift($list, $newElement);
        }

        return json_encode($list);
    }

    public function getOptionIntruktur($search = null, $id = null)
    {
        $datas    = Pengguna::select('id', 'name')
            ->where('level', '2')
            ->whereNull('pengguna.deleted_at');

        if ($search != null) {
            $datas = $datas->where('name', 'like', "%{$search}%");
        }
        if ($id != null) {
            $datas = $datas->where('id', '=', "{$id}");
        }
        $datas = $datas->orderBy('name', 'asc');

        return $datas->get();
    }

    public function listEdit(Request $request, $token = '')
    {
        $data     = $this->getByToken($token);
        $kategori = $this->getOptionKatgeori(null);
        $klasifikasi = $this->getOptionKlasifikasi(null);
        $instruktur = $this->getOptionIntruktur(null);

        return view('admin.courses.list.edit', compact('data', 'kategori', 'klasifikasi', 'instruktur'));
    }

    public function getByToken($token)
    {
        $user     = CourseModal::select(
            [
                'course.*',
                DB::Raw("md5(concat(course.id, '-', date_format(curdate(), '%Y%m%d'))) as _token")

            ],
        )
            ->token($token)
            ->first();

        return $user;
    }

    public function listUpdate(CourseListRequest $data, $token)
    {
        DB::beginTransaction();
        try {
            $save   = CourseModal::token($token)->first();

            $save->update([
                'code'         => $data['code'],
                'kategori_id'         => $data['kategori_id'],
                'klasifikasi_id'         => $data['klasifikasi_id'],
                'instruktur'         => $data['instruktur'],
                'title'         => $data['title'],
                'status'         => $data['status'],
                'live'         => $data['live'],
                'des'         => $data['des'],
                'waktu_per_minggu'         => $data['waktu_per_minggu'],
                'harga'         => $data['harga'],
                'income'         => $data['income'],
            ]);

            if ($data['cover'] != 'undifined') {
                $file = $data->file('cover');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'cover';
                $file->move($tujuan_upload, $nama_file);

                $save->update([
                    'cover'         => $nama_file,
                ]);
            }

            DB::commit();
            return jsonSuccess('Data berhasil di edit');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            return jsonError($th->getMessage());
        }
    }

    public function listDelete($token)
    {
        $user   = CourseModal::token($token)->first();
        if (!empty($user)) {
            $user->delete();
            return jsonSuccess('Data berhasil di hapus');
        } else {
            return jsonSuccess('Token tidak ditemukan');
        }
    }

    public function listView($token = '')
    {
        $data     = $this->getByToken($token);
        $kategori = $this->getOptionKatgeori(null);
        $klasifikasi = $this->getOptionKlasifikasi(null);
        $instruktur = $this->getOptionIntruktur(null);

        return view('admin.courses.list.view', compact('data', 'kategori', 'klasifikasi', 'instruktur', 'token'));
    }

    public function materiList(Request $request, $token)
    {
        $datatables = datatables($this->allMateri($request, $token));

        return $datatables
            //index
            ->addIndexColumn()
            //action
            ->addColumn('action', function ($row) {
                $html = '';
                $html .= '<a href="' . route('courses.materi.edit', $row->_token) . '" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></a>';

                $id = $row->_token;
                $html .= ' &nbsp;<a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteData(' . "'$id'" . ',' . "'$row->name'" . ')"><i class="fa fa-trash"></i></a>';

                $html .= ' &nbsp;<a href="' . route('courses.materi.quiz.tambah', $row->_token) . '" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>';


                return $html;
            })
            //filter
            ->filter(function ($query) use ($request) {
                if ($request->search) {
                    $query->where(
                        function ($q) use ($request) {
                            $q->where('course.title', 'like', '%' . $request->search . '%')
                                ->orWhere('materi_course.title_materi', 'like', '%' . $request->search . '%')
                                ->orWhere('course.code', 'like', '%' . $request->search . '%');
                        },
                    );
                }
            })

            ->escapeColumns([])->toJson();
    }

    public function allMateri($request, $token)
    {
        $data_course   = CourseModal::token($token)->first();

        $filter    = $request['filter'];
        $searchVal = (isset($filter['search'])) ? $filter['search'] : false;

        $data = MateriCourseModal::select([
            DB::raw("md5(concat(materi_course.id,'-',date_format(curdate(), '%Y%m%d'))) as _token"),
            'materi_course.star_date',
            'materi_course.end_date',
            'materi_course.title_materi',
            'materi_course.status_materi',
            'course.title',
            'course.code',
            'course.status',
            'materi_course.created_at',
        ])
            ->leftJoin('course', 'course.id', 'materi_course.course_id');
            if(!empty($data_course->id)){
                $data = $data->where('materi_course.course_id', $data_course->id);
            }
            
            $data = $data->when($searchVal, function ($query) use ($searchVal) {
                $query->where('materi_course.title_materi', 'like', "%{$searchVal}%")
                    ->orWhere('course.title', 'like', "%{$searchVal}%")
                    ->orWhere('course.code', 'like', "%{$searchVal}%");
            });

        return $data;
    }

    public function MateriTambah($token)
    {
        $data   = CourseModal::token($token)->first();
        if (!empty($data)) {
            return view('admin.courses.list.materi_add', compact('token', 'data'));
        }
    }

    public function materiDoCreate(CourseMateriRequest $data)
    {
        DB::beginTransaction();
        try {
            if ($data['file_materi'] != 'undifined') {
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
                'file_materi' => $nama_file
            ]);
            DB::commit();
            return jsonSuccess('Data berhasil di buat');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            return jsonError($th->getMessage());
        }
    }

    public function materiEdit(Request $request, $token = '')
    {
        $data     = $this->getMateriByToken($token);

        return view('admin.courses.list.materi_edit', compact('data'));
    }

    public function MateriDoEdit(CourseMateriRequest $data, $token)
    {
        DB::beginTransaction();
        try {
            $save   = MateriCourseModal::token($token)->first();

            $save->update([
                'course_id'         => $data['course_id'],
                'star_date'         => $data['star_date'],
                'end_date'         => $data['end_date'],
                'title_materi'         => $data['title_materi'],
                'status_materi'         => $data['status_materi'],
                'des_materi'         => $data['des_materi'],
            ]);

            if ($data['file_materi'] != 'undifined') {
                $file = $data->file('file_materi');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'file_materi';
                $file->move($tujuan_upload, $nama_file);

                $save->update([
                    'file_materi'         => $nama_file,
                ]);
            }

            DB::commit();
            return jsonSuccess('Data berhasil di ubah');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            return jsonError($th->getMessage());
        }
    }

    public function getMateriByToken($token)
    {
        $user     = MateriCourseModal::select(
            [
                'materi_course.*',
                DB::Raw("md5(concat(materi_course.id, '-', date_format(curdate(), '%Y%m%d'))) as _token")

            ],
        )
            ->token($token)
            ->first();

        return $user;
    }

    public function materiDoUpdate(CourseMateriRequest $data, $token)
    {
        DB::beginTransaction();
        try {
            if ($data['file_materi'] != 'undifined') {
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
                'file_materi' => $nama_file
            ]);
            DB::commit();
            return jsonSuccess('Data berhasil di buat');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            return jsonError($th->getMessage());
        }
    }

    public function materiDelete($token)
    {
        $user   = MateriCourseModal::token($token)->first();
        if (!empty($user)) {
            $user->delete();
            return jsonSuccess('Data berhasil di hapus');
        } else {
            return jsonSuccess('Token tidak ditemukan');
        }
    }

    public function MateriQuizTambah($token)
    {
        $data   = MateriCourseModal::token($token)->first();
        if (!empty($data)) {
            $data_quiz_parent = BankQuizModal::where('materi_id', $data->id)->first();
            return view('admin.courses.list.materi_quiz_add', compact('token', 'data', 'data_quiz_parent'));
        }
    }

    public function MateriQuizFormTambah($token)
    {
        $data   = MateriCourseModal::token($token)->first();
        if (!empty($data)) {
            return view('admin.courses.list.materi_quiz_add_form', compact('token', 'data'));
        }
    }

    public function materiQuizDoCreate(Request $data)
    {
        DB::beginTransaction();
        try {
            $save             = BankQuizModal::create([
                'course_id'         => $data['course_id'],
                'materi_id'         => $data['materi_id'],
                'title_quiz'         => $data['title_quiz'],
                'des_quiz'         => $data['des_quiz'],
                'waktu_quiz'         => $data['waktu_quiz'],
                'waktu_akhir_quiz'         => $data['waktu_akhir_quiz']
            ]);
            DB::commit();
            return jsonSuccess('Data berhasil di buat');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            return jsonError($th->getMessage());
        }
    }

    public function MateriQuizTambahDetail($token, $quiz_id)
    {
        $data   = MateriCourseModal::token($token)->first();
        if (!empty($data)) {
            return view('admin.courses.list.materi_quiz_add_detail', compact('token', 'data', 'quiz_id'));
        }
    }

    public function getQuizDetail(Request $request, $token)
    {
        $datatables = datatables($this->allGetQuizDetail($request, $token));

        return $datatables
            //index
            ->addIndexColumn()
            //action
            ->addColumn('action', function ($row) {
                $html = '';
                $html .= '<a href="' . route('courses.quiz.edit', $row->_token) . '" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></a>';

                $id = $row->_token;
                $html .= ' &nbsp;<a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteData(' . "'$id'" . ',' . "'$row->pertanyaan'" . ')"><i class="fa fa-trash"></i></a>';

                return $html;
            })
            //filter
            ->filter(function ($query) use ($request) {
                if ($request->search) {
                    $query->where(
                        function ($q) use ($request) {
                            $q->where('cbank_quiz_detailourse.pertanyaan', 'like', '%' . $request->search . '%')
                                ->orWhere('bank_quiz_detail.jawaban', 'like', '%' . $request->search . '%');
                        },
                    );
                }
            })

            ->escapeColumns([])->toJson();
    }

    public function allGetQuizDetail($request, $token)
    {
        $cek_data_course   = MateriCourseModal::token($token)->first();
        if (!empty($cek_data_course)) {
            $filter    = $request['filter'];
            $searchVal = (isset($filter['search'])) ? $filter['search'] : false;

            $data = BankQuizDetailModal::select([
                DB::raw("md5(concat(bank_quiz_detail.id,'-',date_format(curdate(), '%Y%m%d'))) as _token"),
                'bank_quiz_detail.id',
                'bank_quiz_detail.pertanyaan',
                'bank_quiz_detail.bobot_nilai',
                'bank_quiz_detail.created_at'
            ])
            ->where('materi_id', $cek_data_course->id)
                ->when($searchVal, function ($query) use ($searchVal) {
                    $query->where('bank_quiz_detail.pertanyaan', 'like', "%{$searchVal}%")
                    ->orWhere('bank_quiz_detail.jawaban', 'like', "%{$searchVal}%");
                });

            return $data;
        }
    }

    public function quizDoCreate(Request $data)
    {
        $get_materi_course = MateriCourseModal::where('id', $data['materi_id'])->first();
        DB::beginTransaction();
        try {

            $save = new BankQuizDetailModal;
            $save->course_id = $data['course_id'];
            $save->materi_id = $data['materi_id'];
            if(!empty($data['bank_quiz_id'])){
                $save->bank_quiz_id = $data['bank_quiz_id'];
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
            return jsonSuccess('Data berhasil di buat');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            return jsonError($th->getMessage());
        }
    }

    public function quizEdit(Request $request, $token = '')
    {
        $data     = $this->getquizByToken($token);

        return view('admin.courses.list.materi_quiz_edit_detail', compact('data', 'token'));
    }

    public function getquizByToken($token)
    {
        $user     = BankQuizDetailModal::select(
            [
                'bank_quiz_detail.*',
                DB::Raw("md5(concat(bank_quiz_detail.id, '-', date_format(curdate(), '%Y%m%d'))) as _token")

            ],
        )
            ->token($token)
            ->first();

        return $user;
    }

    public function quizUpdate(Request $data, $token)
    {
        DB::beginTransaction();
        try {
            $save   = BankQuizDetailModal::token($token)->first();

            $save->course_id = $data['course_id'];
            $save->materi_id = $data['materi_id'];
            if(!empty($data['bank_quiz_id'])){
                $save->bank_quiz_id = $data['bank_quiz_id'];
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
            return jsonSuccess('Data berhasil di edit');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            return jsonError($th->getMessage());
        }
    }

    public function quizDelete($token)
    {
        $user   = BankQuizDetailModal   ::token($token)->first();
        if (!empty($user)) {
            $user->delete();
            return jsonSuccess('Data berhasil di hapus');
        } else {
            return jsonSuccess('Token tidak ditemukan');
        }
    }

}
