<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModal;

class HomeController extends Controller
{
    public function index() 
    {
        $get_course = CourseModal::limit(3)->get();
        return view('web.beranda', compact('get_course'));
    }

    public function option(Request $request)
    {
        $data = $this->getOption($request->search);
        $list     = [];
        foreach ($data as $key => $row) {
            $list[$key]['id']   = $row->id;
            $list[$key]['text'] = $row->title;
        }

        return json_encode($list); 
    }

    public function getOption($search = null, $id = null)
    {
        $datas    = CourseModal::select('id', 'title')
            ->whereNull('course.deleted_at');

        if ($search != null) {
            $datas = $datas->where('title', 'like', "%{$search}%");
        }
        if ($id != null) {
            $datas = $datas->where('id', '=', "{$id}");
        }
        $datas = $datas->orderBy('title', 'asc');

        return $datas->get();
    }

    public function help()
    {
        return View('web.help');
    }

    public function course() 
    {
        $get_course = CourseModal::get();
        return view('web.course', compact('get_course'));
    }
}
