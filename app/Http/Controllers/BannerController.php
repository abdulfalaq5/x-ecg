<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\BannerModal;
use App\Http\Requests\BannerRequest;

class BannerController extends Controller
{
    public function index()
    {
        return view('banner.index');
    }

    public function list(Request $request)
    {
        $datatables = datatables($this->allBanner($request));

        return $datatables
            //index
            ->addIndexColumn()
            //action
            ->addColumn('action', function ($row) {
                $html = '';
                $html .= '<a href="' . route('cms.banner.edit', $row->_token) . '" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></a>';

                $id = $row->_token;
                $html .= ' &nbsp;<a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteData(' . "'$id'" . ',' . "'$row->title'" . ')"><i class="fa fa-trash"></i></a>';

                return $html;
            })
            //filter
            ->filter(function ($query) use ($request) {
                if ($request->search) {
                    $query->where(
                        function ($q) use ($request) {
                            $q->where('banner.title_banner', 'like', '%' . $request->search . '%')
                                ->orWhere('banner.des_banner', 'like', '%' . $request->search . '%');
                        },
                    );
                }
            })

            ->escapeColumns([])->toJson();
    }

    public function allBanner($request)
    {
        $filter    = $request['filter'];
        $searchVal = (isset($filter['search'])) ? $filter['search'] : false;

        $data = BannerModal::select([
            DB::raw("md5(concat(banner.id,'-',date_format(curdate(), '%Y%m%d'))) as _token"),
            'banner.id',
            'banner.title_banner',
            'banner.des_banner',
            'banner.image',
            'banner.created_at'
        ])
            ->when($searchVal, function ($query) use ($searchVal) {
                $query->where('banner.title_banner', 'like', "%{$searchVal}%")
                    ->orWhere('banner.des_banner', 'like', "%{$searchVal}%");
            });

        return $data;
    }

    public function create(Request $request)
    {
        return view('banner.create');
    }

    public function doCreate(BannerRequest $data)
    {
        DB::beginTransaction();
        try {
            if ($data['image'] != 'undifined') {
                $file = $data->file('image');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'image';
                $file->move($tujuan_upload, $nama_file);
            }

            $user             = BannerModal::create([
                'title_banner'         => $data['title_banner'],
                'des_banner'         => $data['des_banner'],
                'image' => $nama_file
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

        return view('banner.edit', compact('data'));
    }

    public function getByToken($token)
    {
        $user     = BannerModal::select(
            [
                'banner.*',
                DB::Raw("md5(concat(banner.id, '-', date_format(curdate(), '%Y%m%d'))) as _token")

            ],
        )
            ->token($token)
            ->first();

        return $user;
    }

    public function update(BannerRequest $data, $token)
    {
        DB::beginTransaction();
        try {
            $save   = BannerModal::token($token)->first();

            $save->update([
                'title_banner'         => $data['title_banner'],
                'des_banner'         => $data['des_banner'],
            ]);

            if ($data['image'] != 'undifined') {
                $file = $data->file('image');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'image';
                $file->move($tujuan_upload, $nama_file);

                $save->update([
                    'image'         => $nama_file,
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

    public function delete($token)
    {
        $user   = BannerModal::token($token)->first();
        if (!empty($user)) {
            $user->delete();
            return jsonSuccess('Data berhasil di hapus');
        } else {
            return jsonSuccess('Token tidak ditemukan');
        }
    }
}
