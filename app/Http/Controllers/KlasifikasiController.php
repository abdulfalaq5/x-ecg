<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\KlasifikasiModal;
use App\Http\Requests\KlasifikasiRequest;

class KlasifikasiController extends Controller
{
    public function index()
    {
        return view('klasifikasi.index');
    }

    public function list(Request $request)
    {
        $datatables = datatables($this->allData($request));

        return $datatables
            //index
            ->addIndexColumn()
            //action
            ->addColumn('action', function ($row) {
                $html = '';
                $html .= '<a href="' . route('master.klasifikasi.edit', $row->_token) . '" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></a>';

                $id = $row->_token;
                $html .= ' &nbsp;<a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteData(' . "'$id'" . ',' . "'$row->klasifikasi_name'" . ')"><i class="fa fa-trash"></i></a>';

                return $html;
            })
            //filter
            ->filter(function ($query) use ($request) {
                if ($request->search) {
                    $query->where(
                        function ($q) use ($request) {
                            $q->where('klasifikasi.klasifikasi_name', 'like', '%' . $request->search . '%');
                        },
                    );
                }
            })

            ->escapeColumns([])->toJson();
    }

    public function allData($request)
    {
        $filter    = $request['filter'];
        $searchVal = (isset($filter['search'])) ? $filter['search'] : false;

        $data = KlasifikasiModal::select([
            DB::raw("md5(concat(klasifikasi.id,'-',date_format(curdate(), '%Y%m%d'))) as _token"),
            'klasifikasi.id',
            'klasifikasi.klasifikasi_name',
            'klasifikasi.created_at'
        ])
            ->when($searchVal, function ($query) use ($searchVal) {
                $query->where('klasifikasi.klasifikasi_name', 'like', "%{$searchVal}%");
            });

        return $data;
    }

    public function create(Request $request)
    {
        return view('klasifikasi.create');
    }

    public function doCreate(KlasifikasiRequest $data)
    {
        DB::beginTransaction();
        try {

            $user             = KlasifikasiModal::create([
                'klasifikasi_name'         => $data['klasifikasi_name']
            ]);
            DB::commit();
            return jsonSuccess('Data berhasil di buat');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            return jsonError($th->getMessage());
        }
    }

    public function edit(Request $request, $token = '')
    {
        $data     = $this->getByToken($token);

        return view('klasifikasi.edit', compact('data'));
    }

    public function getByToken($token)
    {
        $user     = KlasifikasiModal::select(
            [
                'klasifikasi.*',
                DB::Raw("md5(concat(klasifikasi.id, '-', date_format(curdate(), '%Y%m%d'))) as _token")

            ],
        )
            ->token($token)
            ->first();

        return $user;
    }

    public function update(KlasifikasiRequest $data, $token)
    {
        DB::beginTransaction();
        try {
            $save   = KlasifikasiModal::token($token)->first();

            $save->update([
                'klasifikasi_name'         => $data['klasifikasi_name'],
            ]);

            DB::commit();
            return jsonSuccess('Data berhasil di edit');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            return jsonError($th->getMessage());
        }
    }

    public function delete($token)
    {
        $user   = KlasifikasiModal::token($token)->first();
        if (!empty($user)) {
            $user->delete();
            return jsonSuccess('Data berhasil di hapus');
        } else {
            return jsonSuccess('Token tidak ditemukan');
        }
    }
}
