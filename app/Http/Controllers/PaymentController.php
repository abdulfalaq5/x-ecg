<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PaymentModal;
use App\Models\TagihanModal;
use App\Models\CourseModal;
use App\Models\Pengguna;
use App\Models\MyCourseModal;
use App\Http\Repositories\GeneretedPaymentRepository;


class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.index');
    }

    public function tagihanList(Request $request)
    {
        $datatables = datatables($this->allTagihan($request));

        return $datatables
            //index
            ->addIndexColumn()
            //action
            ->addColumn('action', function ($row) {
                $html = '';
                $html .= '<a href="' . route('payment.view', $row->_token) . '" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>';

                return $html;
            })
            //filter
            ->filter(function ($query) use ($request) {
                if ($request->search) {
                    $query->where(
                        function ($q) use ($request) {
                            $q->where('pengguna.name', 'like', '%' . $request->search . '%')
                                ->orWhere('pengguna.email', 'like', '%' . $request->search . '%')
                                ->orWhere('tagihan.total_tagihan', 'like', '%' . $request->search . '%')
                                ->orWhere('course.title', 'like', '%' . $request->search . '%')
                                ->orWhere('course.code', 'like', '%' . $request->search . '%');
                        },
                    );
                }
            })

            ->escapeColumns([])->toJson();
    }

    public function allTagihan($request)
    {
        $filter    = $request['filter'];
        $searchVal = (isset($filter['search'])) ? $filter['search'] : false;

        $data = TagihanModal::select([
            DB::raw("md5(concat(tagihan.id,'-',date_format(curdate(), '%Y%m%d'))) as _token"),
            'tagihan.id',
            'tagihan.total_tagihan',
            'course.code',
            'course.title',
            'pengguna.name',
            'pengguna.email',
            'payment.status'
        ])
            ->leftJoin('pengguna', 'pengguna.id', 'tagihan.pengguna_id')
            ->leftJoin('payment', 'payment.tagihan_id', 'tagihan.id')
            ->leftJoin('course', 'course.id', 'tagihan.course_id')
            ->when($searchVal, function ($query) use ($searchVal) {
                $query->where('pengguna.name', 'like', "%{$searchVal}%")
                    ->orWhere('pengguna.email', 'like', "%{$searchVal}%")
                    ->orWhere('tagihan.total_tagihan', 'like', "%{$searchVal}%")
                    ->orWhere('course.title', 'like', "%{$searchVal}%")
                    ->orWhere('course.code', 'like', "%{$searchVal}%");
            });

        return $data;
    }

    public function getSnapToken(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $data = [];
        $getCourseById = CourseModal::where('id', $request->input('course_id'))->first();
        $getDataPeserta = Pengguna::where('id', $user_id)->first();
        $result = (new GeneretedPaymentRepository)->getSnapToken($request, $getCourseById, $getDataPeserta);
        $cek = 1;
        for ($i = 0; $i < $cek;) {
            if ($result) {
                $i++;
            } else {
                $result = (new GeneretedPaymentRepository)->getSnapToken($request, $getCourseById, $getDataPeserta);
            }
        }
        $data = [
            'token' => $result['token'],
            //'redirect_url' => $result['redirect_url'],
        ];
        return $data;
    }

    public function suksesPayment()
    {
        return view('peserta.payment-sukses.blade');
    }

    public function regCourse(Request $data)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $course_id = $data['course_id'];

        $data = [];
        $getCourseById = CourseModal::where('id', $course_id)->first();
        $getDataPeserta = Pengguna::where('id', $user_id)->first();
        $save = new MyCourseModal;
        $save->peserta_id = $user_id;
        $save->course_id = $course_id;
        $save->status = 1; //1: aktive; 2: nonaktive
        $save->save(); 
        return redirect()->route('peserta.mycourse');
    }
}
