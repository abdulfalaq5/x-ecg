<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\UsertListController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KlasifikasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(HomeController::class)->name('home.')->group(function () {
    /////      nama url  nama function       nama router
    Route::get('/', 'index')->name('index');
    Route::get('/home-option', 'option')->name('option');
    Route::get('/help', 'help')->name('help');
    Route::get('/course', 'course')->name('course');
});

Route::controller(RegisterController::class)->name('register.')->prefix('register')->group(function () {
    /////      nama url  nama function       nama router
    Route::get('/', 'formRegister')->name('add');
    Route::post('/', 'simpan')->name('simpan');
});

Route::controller(LoginController::class)->name('login.')->prefix('login')->group(function () {
    /////      nama url  nama function       nama router
    Route::get('/', 'formLogin')->name('index');
    Route::post('/proses-login', 'prosesLogin')->name('proses-login');
});

Route::controller(AdminController::class)->name('admin.')->middleware('CekLogin:1')->prefix('admin')->group(function () {
    /////      nama url  nama function       nama router
    Route::get('/', 'berandaAdmin')->name('beranda');
});

Route::controller(UsertListController::class)->name('user.')->middleware('CekLogin:1')->prefix('user')->group(function () {
    /////      nama url  nama function       nama router
    //instruktur
    Route::get('/instruktur', 'instrukturIndex')->name('instruktur');
    Route::post('/instruktur-list', 'instrukturList')->name('instruktur.list');
    Route::get('/instruktur-create', 'instrukturCreate')->name('instruktur.create');
    Route::post('/instruktur-do-create', 'instrukturDoCreate')->name('instruktur.do.create');
    Route::get('/instruktur-edit/{token?}', 'instrukturEdit')->name('instruktur.edit');
    Route::post('/{token}/instruktur-update', 'instrukturUpdate')->name('instruktur.update');
    Route::delete('/instruktur-delete/{token?}', 'instrukturDelete')->name('instruktur.delete');

    //peserta
    Route::get('/participant', 'participantIndex')->name('participant');
    Route::post('/participant-list', 'participantList')->name('participant.list');
    Route::get('/participant-create', 'participantCreate')->name('participant.create');
    Route::post('/participant-do-create', 'participantDoCreate')->name('participant.do.create');
    Route::get('/participant-edit/{token?}', 'participantEdit')->name('participant.edit');
    Route::post('/{token}/participant-update', 'participantUpdate')->name('participant.update');
    Route::delete('/participant-delete/{token?}', 'participantDelete')->name('participant.delete');
});

Route::controller(CourseController::class)->name('courses.')->middleware('CekLogin:1')->prefix('courses')->group(function () {
    //list
    Route::get('/list', 'listIndex')->name('list');
    Route::post('/get-list', 'listList')->name('get.list');
    Route::get('/list-create', 'listCreate')->name('list.create');
    Route::post('/list-do-create', 'listDoCreate')->name('list.do.create');
    Route::get('/list-edit/{token?}', 'listEdit')->name('list.edit');
    Route::post('/{token}/list-update', 'listUpdate')->name('list.update');
    Route::delete('/list-delete/{token?}', 'listDelete')->name('list.delete');
    Route::get('/list-view/{token?}', 'listView')->name('list.view');
    Route::post('/get-materi/{token?}', 'materiList')->name('get.materi');
    Route::get('/materi-tambah/{token?}', 'MateriTambah')->name('materi.tambah');
    Route::post('/materi-do-create', 'materiDoCreate')->name('materi.do.create');
    Route::get('/materi-edit/{token?}', 'MateriEdit')->name('materi.edit');
    Route::post('/{token}/materi-update', 'MateriDoEdit')->name('materi.update');
    Route::delete('/materi-delete/{token?}', 'materiDelete')->name('materi.delete');
    
    Route::get('/materi-quiz-tambah/{token?}', 'MateriQuizTambah')->name('materi.quiz.tambah');
    Route::get('/materi-quiz-tambah-form/{token?}', 'MateriQuizFormTambah')->name('materi.quiz.tambah.form');
    Route::post('/materi-quiz-do-create', 'materiQuizDoCreate')->name('materi.quiz.do.create');
    Route::get('/materi-quiz-tambah-detail/{token?}/{id?}', 'MateriQuizTambahDetail')->name('materi.quiz.tambah.detail');
    Route::post('/get-quiz-detail/{token?}', 'getQuizDetail')->name('get.quiz.detail');
    Route::post('/quiz-do-create', 'quizDoCreate')->name('quiz.do.create');
    Route::get('/quiz-edit/{token?}', 'quizEdit')->name('quiz.edit');
    Route::post('/{token}/quiz-update', 'quizUpdate')->name('quiz.update');
    Route::delete('/quiz-delete/{token?}', 'quizDelete')->name('quiz.delete');
    


    //option kategori dan klasifikasi
    Route::get('/kategori-option', 'optionKatgeori')->name('kategori.option');
    Route::get('/klasifikasi-option', 'optionKlasifikasi')->name('klasifikasi.option');
    Route::get('/instruktur-option', 'optionInstruktur')->name('instruktur.option');
    
    //module
    Route::get('/module', 'moduleIndex')->name('module');
    Route::post('/get-module', 'moduleList')->name('get.module');
    Route::get('/module-create', 'moduleCreate')->name('module.create');
    Route::post('/module-do-create', 'moduleDoCreate')->name('module.do.create');
    Route::get('/module-edit/{token?}', 'moduleEdit')->name('module.edit');
    Route::post('/{token}/module-update', 'moduleUpdate')->name('module.update');
    Route::delete('/module-delete/{token?}', 'moduleDelete')->name('module.delete');

});

Route::controller(PaymentController::class)->name('payment.')->prefix('payment')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/tagihan-list', 'tagihanList')->name('tagihan.list');
    Route::get('/get-snap-token', 'getSnapToken')->name('snaptoken');
    Route::get('/sukses-payment', 'suksesPayment')->name('sukses');
    Route::post('/reg-course', 'regCourse')->name('regCourse');
});

Route::controller(BannerController::class)->name('cms.banner.')->middleware('CekLogin:1')->prefix('cms/banner')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/list', 'list')->name('list');
    Route::get('/create', 'create')->name('create');
    Route::post('/do-create', 'doCreate')->name('do.create');
    Route::get('/edit/{token?}', 'edit')->name('edit');
    Route::post('/{token}/update', 'update')->name('update');
    Route::delete('/delete/{token?}', 'delete')->name('delete');
});

Route::controller(KategoriController::class)->name('master.kategori.')->middleware('CekLogin:1')->prefix('master/kategori')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/list', 'list')->name('list');
    Route::get('/create', 'create')->name('create');
    Route::post('/do-create', 'doCreate')->name('do.create');
    Route::get('/edit/{token?}', 'edit')->name('edit');
    Route::post('/{token}/update', 'update')->name('update');
    Route::delete('/delete/{token?}', 'delete')->name('delete');
});

Route::controller(KlasifikasiController::class)->name('master.klasifikasi.')->middleware('CekLogin:1')->prefix('master/klasifikasi')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/list', 'list')->name('list');
    Route::get('/create', 'create')->name('create');
    Route::post('/do-create', 'doCreate')->name('do.create');
    Route::get('/edit/{token?}', 'edit')->name('edit');
    Route::post('/{token}/update', 'update')->name('update');
    Route::delete('/delete/{token?}', 'delete')->name('delete');
});

Route::controller(CmsController::class)->name('cms.')->middleware('CekLogin:1')->prefix('cms')->group(function () {
    //Route::get('/banner', 'index')->name('banner');
    Route::get('/tentangkami', 'index')->name('tentangkami');
    Route::get('/help', 'index')->name('help');
});

Route::controller(EditorController::class)->name('editor.')->middleware('CekLogin:2')->prefix('editor')->group(function () {
    /////      nama url  nama function       nama router
    Route::get('/', 'berandaEditor')->name('beranda');
    Route::get('/course/detail/{id}', 'detailCourse')->name('course.detail');
    Route::get('/course/add/{id}', 'formAddMateri')->name('course.add');
    Route::get('/materi/edit/{id}/{materi}', 'editMateri')->name('materi.edit');
    Route::post('/materi/doedit', 'doeditMateri')->name('materi.doedit');
    Route::get('/materi/delete/{id}', 'deleteMateri')->name('materi.delete');
    Route::post('/course/doadd', 'doAddMateri')->name('course.doadd');
    Route::get('/module/add/{id}/{materi}', 'formAddModule')->name('module.add');
    Route::post('/module/doadd', 'doAddModule')->name('module.doadd');
    Route::get('/module/detail/{id}/{materi}/{module}', 'detailModule')->name('module.detail');
    Route::get('/module/edit/{id}/{module}', 'editModule')->name('module.edit');
    Route::get('/module/delete/{id}', 'deleteModule')->name('module.delete');
    Route::post('/module/doedit', 'doeditModule')->name('module.doedit');
    Route::get('/quiz/{id}/{materi}/{module}', 'quiz')->name('quiz.index');
    Route::get('/quiz/add/{id}/{materi}/{module}', 'formAddQuiz')->name('quiz.add');
    Route::post('/quiz/doadd', 'doAddQuiz')->name('quiz.doadd');
    Route::get('/quiz/detail/{quiz}/{id}/{materi}/{module}', 'detailQuiz')->name('quiz.detail');
    Route::get('/quiz/edit/{quiz}/{id}/{materi}/{module}', 'editQuiz')->name('quiz.edit');
    Route::post('/quiz/doedit', 'doEditQuiz')->name('quiz.doedit');
    Route::get('/quiz/delete/{quiz}/{id}/{materi}/{module}', 'deleteQuiz')->name('quiz.delete');
    Route::get('/quiz/detail/add/{quiz}/{id}/{materi}/{module}', 'addDetailQuiz')->name('quiz.detail.add');
    Route::get('/quiz/detail/import/{quiz}/{id}/{materi}/{module}', 'importDetailQuiz')->name('quiz.detail.import');
    Route::post('/quiz/detail/doadd', 'doAddDetailQuiz')->name('quiz.detail.doadd');
    Route::post('/quiz/detail/doimport', 'doImportDetailQuiz')->name('quiz.detail.doimport');
    Route::get('/quiz/detail/delete/{detail}/{quiz}/{id}/{materi}/{module}', 'deleteDetailQuiz')->name('quiz.detail.delete');
    Route::get('/konten/{id}/{materi}/{module}', 'formKonten')->name('konten');
    Route::post('/konten/doadd', 'doaddKonten')->name('konten.doadd');
});

Route::controller(PesertaController::class)->name('peserta.')->middleware('CekLogin:3')->prefix('peserta')->group(function () {
    /////      nama url  nama function       nama router
    Route::get('/', 'berandaPeserta')->name('beranda');
    Route::get('/mycourse-list', 'mycourseList')->name('mycourse');
    Route::get('/course-list', 'courseList')->name('course');
    Route::get('/course-detail/{id}', 'courseDetail')->name('course.detail');
    Route::get('/course-detail-conten/{id}', 'courseDetailConten')->name('course.conten');
    Route::get('/course-detail-quiz/{id}', 'courseDetailQuiz')->name('course.quiz');
    Route::post('/regCourse', 'regCourse')->name('regCourse');
    Route::get('/module/detail/{id}/{materi}/{module}', 'detailModule')->name('module.detail');
    Route::get('/module/quiz/{quiz}/{id}/{materi}', 'quiz')->name('quiz.index');
    Route::post('/simpanquiz', 'simpanQuiz')->name('simpanquiz');
    Route::get('/sertifikat/{id}', 'getSertifikat')->name('sertifikat');
    Route::get('/cetakSertifikat', 'cetakSertifikat')->name('cetakSertifikat');
});

Route::controller(LogoutController::class)->name('logout.')->prefix('logout')->group(function () {
    /////      nama url  nama function       nama router
    Route::get('/', 'logout')->name('index');
});

Route::controller(LupaPasswordController::class)->name('forgot.')->prefix('forgot')->group(function () {
    /////      nama url  nama function       nama router
    Route::get('/', 'formLupaPassword')->name('form-forgot');
    Route::post('/proses', 'prosesLupaPassword')->name('proses');
    Route::get('/reset-password/{token}', 'resetPassword')->name('reset-password');
    Route::post('/proses-reset', 'prosesResetPassword')->name('proses-reset');
});


