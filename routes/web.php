<?php

use App\Models\Surat;
use App\Models\Driver;
use App\Models\Report;
use App\Models\ReportActivity;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth']);
Route::get('/dashboard', [DashboardController::class, 'chart'])->name('driver.chart')->middleware(['auth']);



Route::resource('/user/reservasi', ReservationController::class)->middleware('auth');
Route::resource('/admin/reservasi', ReservationController::class)->middleware('auth');
Route::resource('reservasi', ReservationController::class)->middleware('auth');



Route::get('/template', function () {
    return view('template',[
        "title" => "Template",
        "templates" => Surat::all()
    ]);
})->middleware('auth');

Route::get('/percobaan', function () {
    $lastReportId = Report::orderBy('id', 'desc')->first()->id;
    $report = ReportActivity::where('report_id', $lastReportId)->get();
    return view('percobaan', [
        "title" => "Kirim Wa",
        'reports' => $report,
        "surats" => Surat::all(),
    ]);
})->middleware('auth');

Route::get('/edittemplate', [TemplateController::class, 'index'])->name('edittemplate')->middleware('auth');
Route::post('/edittemplate/store', [TemplateController::class, 'store'])->name('store')->middleware('auth');
Route::get('/pdfLdp/{id}', [TemplateController::class, 'show'])->name('pdfLdp')->middleware('auth');
Route::get('/uploadldp', [TemplateController::class, 'upload'])->name('upload')->middleware('auth');
Route::post('/uploadldp', [TemplateController::class, 'kirim'])->name('kirim')->middleware('auth');
Route::get('/kirimemail/{id}', [TemplateController::class, 'email'])->name('kirimemail')->middleware('auth');
Route::get('/kirimWa', function() {
    $lastReportId = Report::orderBy('id', 'desc')->first()->id;
    $report = ReportActivity::where('report_id', $lastReportId)->get();
    return view('kirimWa', [
        "title" => "Kirim Wa",
        'reports' => $report,
        "surats" => Surat::all(),
    ]);
})->name('kirimWa');



Route::get('/admin/driver', [DriverController::class, 'index']
)->middleware('auth');

Route::get('/user/driver', function(){
    return view('user.driver', [
        'title' => 'Driver',
        'sopir' => Driver::all(),
    ]);
}
)->middleware('auth');

Route::put('/drivers/{id}', [DriverController::class, 'update'])->name('driver.update');
Route::put('/driver/update-status/{id}', [DriverController::class, 'updateStatus'])->name('driver.updateStatus');



Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);




