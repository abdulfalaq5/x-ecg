<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\KategoriModal;
use App\Http\Requests\KategoriRequest;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategori.index');
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
                $html .= '<a href="' . route('master.kategori.edit', $row->_token) . '" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></a>';

                $id = $row->_token;
                $html .= ' &nbsp;<a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteData(' . "'$id'" . ',' . "'$row->kategori_name'" . ')"><i class="fa fa-trash"></i></a>';

                return $html;
            })
            //filter
            ->filter(function ($query) use ($request) {
                if ($request->search) {
                    $query->where(
                        function ($q) use ($request) {
                            $q->where('kategori.kategori_name', 'like', '%' . $request->search . '%');
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

        $data = KategoriModal::select([
            DB::raw("md5(concat(kategori.id,'-',date_format(curdate(), '%Y%m%d'))) as _token"),
            'kategori.id',
            'kategori.kategori_name',
            'kategori.created_at'
        ])
            ->when($searchVal, function ($query) use ($searchVal) {
                $query->where('kategori.kategori_name', 'like', "%{$searchVal}%");
            });

        return $data;
    }

    public function create(Request $request)
    {
        return view('kategori.create');
    }

    public function doCreate(KategoriRequest $data)
    {
        DB::beginTransaction();
        try {

            $user             = KategoriModal::create([
                'kategori_name'         => $data['kategori_name']
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

        return view('kategori.edit', compact('data'));
    }

    public function getByToken($token)
    {
        $user     = KategoriModal::select(
            [
                'kategori.*',
                DB::Raw("md5(concat(kategori.id, '-', date_format(curdate(), '%Y%m%d'))) as _token")

            ],
        )
            ->token($token)
            ->first();

        return $user;
    }

    public function update(KategoriRequest $data, $token)
    {
        DB::beginTransaction();
        try {
            $save   = KategoriModal::token($token)->first();

            $save->update([
                'kategori_name'         => $data['kategori_name'],
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
        $user   = KategoriModal::token($token)->first();
        if (!empty($user)) {
            $user->delete();
            return jsonSuccess('Data berhasil di hapus');
        } else {
            return jsonSuccess('Token tidak ditemukan');
        }
    }
}
