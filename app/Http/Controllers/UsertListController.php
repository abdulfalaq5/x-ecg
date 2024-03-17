<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest as AdminUserRequest;

class UsertListController extends Controller
{
    public function instrukturIndex()
    {
        return view('admin.user.instruktur.index');
    }

    public function instrukturCreate(Request $request)
    {
        return view('admin.user.instruktur.create');
    }

    public function instrukturDoCreate(AdminUserRequest $data)
    {
        DB::beginTransaction();
        try {
            $user             = Pengguna::create([
                'name'         => $data['name'],
                'email'        => $data['email'],
                'username'        => $data['email'],
                'phone_number'        => $data['phone_number'],
                'password'     => Hash::make($data['password']),
                'level'      => '2'
            ]);
            DB::commit();
            return jsonSuccess('Data berhasil di buat');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            return jsonError($th->getMessage());
        }
    }

    public function instrukturEdit(Request $request, $token = '')
    {
        $data     = $this->getUserByToken($token);

        return view('admin.user.instruktur.edit', compact('data'));
    }

    public function instrukturUpdate(AdminUserRequest $data, $token)
    {
        DB::beginTransaction();
        try {
            $user   = Pengguna::token($token)->first();

            $user->update([
                'name'         => $data['name'],
                'email'        => $data['email'],
                'phone_number'      => $data['phone_number'],
            ]);

            if ($data['password'] != null) {
                $user->update([
                    'password' => Hash::make($data['password']),
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

    public function getUserByToken($token)
    {
        $user     = Pengguna::select(
            [
                'pengguna.*',
                DB::Raw("md5(concat(pengguna.id, '-', date_format(curdate(), '%Y%m%d'))) as _token")

            ],
        )
            ->token($token)
            ->first();

        return $user;
    }

    public function instrukturDelete($token)
    {
        $user   = Pengguna::token($token)->first();
        if(!empty($user)){
            $user->delete();
            return jsonSuccess('Data berhasil di hapus');
        }else{
            return jsonSuccess('Token tidak ditemukan');
        }
    }

    public function participantIndex()
    {
        return view('admin.user.participant.index');
    }

    public function participantCreate()
    {
        return view('admin.user.participant.create');
    }

    public function participantDoCreate(AdminUserRequest $data)
    {
        DB::beginTransaction();
        try {
            $user             = Pengguna::create([
                'name'         => $data['name'],
                'email'        => $data['email'],
                'username'        => $data['email'],
                'phone_number'        => $data['phone_number'],
                'password'     => Hash::make($data['password']),
                'level'      => '3'
            ]);
            DB::commit();
            return jsonSuccess('Data berhasil di buat');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            return jsonError($th->getMessage());
        }
    }

    public function instrukturList(Request $request)
    {
        $datatables = datatables($this->allInstruktur($request));

        return $datatables
            //index
            ->addIndexColumn()
            //action
            ->addColumn('action', function ($row) {
                $html = '';
                $html .= '<a href="' . route('user.instruktur.edit', $row->_token) . '" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></a>';

                $id = $row->_token;
                $html .= ' &nbsp;<a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteData(' . "'$id'" . ',' . "'$row->name'" . ')"><i class="fa fa-trash"></i></a>';

                return $html;
            })
            //filter
            ->filter(function ($query) use ($request) {
                if ($request->search) {
                    $query->where(
                        function ($q) use ($request) {
                            $q->where('pengguna.name', 'like', '%' . $request->search . '%')
                                ->orWhere('pengguna.email', 'like', '%' . $request->search . '%');
                        },
                    );
                }
            })

            ->escapeColumns([])->toJson();
    }

    public function allInstruktur($request)
    {
        $filter    = $request['filter'];
        $searchVal = (isset($filter['search'])) ? $filter['search'] : false;

        $data = Pengguna::select([
            DB::raw("md5(concat(pengguna.id,'-',date_format(curdate(), '%Y%m%d'))) as _token"),
            'pengguna.id',
            'pengguna.name',
            'pengguna.phone_number',
            'pengguna.email',
            'pengguna.created_at',
        ])
            ->where('level', '2')
            ->when($searchVal, function ($query) use ($searchVal) {
                $query->where('pengguna.name', 'like', "%{$searchVal}%")
                    ->orWhere('pengguna.email', 'like', "%{$searchVal}%");
            });

        return $data;
    }

    public function participantList(Request $request)
    {
        $datatables = datatables($this->allParticipant($request));

        return $datatables
            //index
            ->addIndexColumn()
            //action
            ->addColumn('action', function ($row) {
                $html = '';
                $html .= '<a href="' . route('user.participant.edit', $row->_token) . '" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></a>';

                $id = $row->_token;
                $html .= ' &nbsp;<a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteData(' . "'$id'" . ',' . "'$row->name'" . ')"><i class="fa fa-trash"></i></a>';

                return $html;
            })
            //filter
            ->filter(function ($query) use ($request) {
                if ($request->search) {
                    $query->where(
                        function ($q) use ($request) {
                            $q->where('pengguna.name', 'like', '%' . $request->search . '%')
                                ->orWhere('pengguna.email', 'like', '%' . $request->search . '%');
                        },
                    );
                }
            })

            ->escapeColumns([])->toJson();
    }

    public function allParticipant($request)
    {
        $filter    = $request['filter'];
        $searchVal = (isset($filter['search'])) ? $filter['search'] : false;

        $data = Pengguna::select([
            DB::raw("md5(concat(pengguna.id,'-',date_format(curdate(), '%Y%m%d'))) as _token"),
            'pengguna.id',
            'pengguna.name',
            'pengguna.phone_number',
            'pengguna.email',
            'pengguna.created_at',
        ])
            ->where('level', '3')
            ->when($searchVal, function ($query) use ($searchVal) {
                $query->where('pengguna.name', 'like', "%{$searchVal}%")
                    ->orWhere('pengguna.email', 'like', "%{$searchVal}%");
            });

        return $data;
    }

    public function participantEdit(Request $request, $token = '')
    {
        $data     = $this->getUserByToken($token);

        return view('admin.user.participant.edit', compact('data'));
    }

    public function participantUpdate(AdminUserRequest $data, $token)
    {
        DB::beginTransaction();
        try {
            $user   = Pengguna::token($token)->first();

            $user->update([
                'name'         => $data['name'],
                'email'        => $data['email'],
                'phone_number'      => $data['phone_number'],
            ]);

            if ($data['password'] != null) {
                $user->update([
                    'password' => Hash::make($data['password']),
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

    public function participantDelete($token)
    {
        $user   = Pengguna::token($token)->first();
        if(!empty($user)){
            $user->delete();
            return jsonSuccess('Data berhasil di hapus');
        }else{
            return jsonSuccess('Token tidak ditemukan');
        }
        
    }

}
