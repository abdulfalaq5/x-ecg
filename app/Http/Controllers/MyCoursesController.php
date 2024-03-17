<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseModal;
use Illuminate\Support\Facades\Auth;

class MyCoursesController extends Controller
{
    public function list()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $data_course = CourseModal::select(
            'course.name',
            'course.instruktur',
            )
        ->where('peserta_id', $user_id)
        ->get();
        $jml_data = count($data_course);
        if($jml_data == 0){
            return View('web.course.my-have-courses', compact('data_course'));
        }else{
            return View('web.course.my-courses');
        }
        
    }

    public function listHave()
    {
        return View('web.course.my-have-courses');
    }

    public function listHome()
    {
        return View('web.course.my-home-courses');
    }

    public function listDetailHome()
    {
        return View('web.course.my-detail-courses');
    }

    public function listDetailKonten()
    {
        return View('web.course.my-detail-konten-courses');
    }

    public function kuis()
    {
        return View('web.course.kuis');
    }

    public function kuisPilih()
    {
        return View('web.course.kuis-pilih');
    }

    public function kuisJawab()
    {
        return View('web.course.kuis-jawab');
    }

    public function kuisJawabMcq()
    {
        return View('web.course.kuis-jawab-mcq');
    }

    public function kuisJawabPairing()
    {
        return View('web.course.kuis-jawab-pairing');
    }

    public function kuisRating()
    {
        return View('web.course.kuis-rating');
    }

    public function sertifikat()
    {
        return View('web.course.sertifikat');
    }

    public function kuisNopassed()
    {
        return View('web.course.kuis-nopassed');
    }

    public function kuisPassed()
    {
        return View('web.course.kuis-passed');
    }

    public function sertifikatKlaim()
    {
        return View('web.course.sertifikat-klaim');
    }

    public function sertifikatKlaim1()
    {
        return View('web.course.sertifikat-klaim-1');
    }

    public function rating()
    {
        return View('web.course.rating');
    }

    public function paymentDetail()
    {
        return View('web.course.payment-detail');
    }

    public function paymentDetailMethod()
    {
        return View('web.course.payment-detail-method');
    }

    public function paymentDetailFinansial()
    {
        return View('web.course.payment-detail-finansial');
    }

    public function paymentDetailFinansialReview()
    {
        return View('web.course.payment-detail-finansial-review');
    }

    public function paymentSukses()
    {
        return View('web.course.payment-sukses');
    }
}
