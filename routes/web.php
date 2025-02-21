<?php

use App\Http\Controllers\AchieveController;
use App\Http\Controllers\AlergicController;
use App\Http\Controllers\CoreController;
use App\Http\Controllers\DataDiriController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\EduController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MajelisController;
use App\Http\Controllers\OrgController;
use App\Http\Controllers\PaperController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReadInController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [CoreController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('events', EventController::class); // Kegiatan
    Route::resource('diseases', DiseaseController::class); // Penyakit
    Route::resource('alergics', AlergicController::class); // Alergi

    Route::get('/join-event/{event}', [CoreController::class, 'joinEvent'])->name('join.event');

    /** Kajian Route */
    Route::get('/kajian', [MajelisController::class, 'index'])->name('kajian.index');
    Route::get('/kajian/history', [MajelisController::class, 'listView'])->name('kajian.list');
    Route::get('/kajian/history/tambah', [MajelisController::class, 'create'])->name('kajian.create');
    Route::post('/kajian/history/', [MajelisController::class, 'store'])->name('kajian.store');
    Route::patch('/kajian/history/{kajianId}', [MajelisController::class, 'update'])->name('kajian.update');
    Route::get('/kajian/{kajianId}/edit', [MajelisController::class, 'edit'])->name('kajian.edit');
    /** END Kajian Route */


    // Profile Route
    Route::resource('dataDiri', DataDiriController::class); // Data Diri Resource
    Route::resource('eduhistory', EduController::class); // Riwayat Pendidikan
    Route::resource('orgHistories', OrgController::class); // Riwayat Organisasi
    Route::resource('achievement', AchieveController::class); // Prestasi
    Route::resource('ownpaper', PaperController::class); // Karya Tulis
    Route::resource('readInterest', ReadInController::class); // Minat Baca
    Route::post('/datadiri', [CoreController::class, 'storeProfilePic'])->name('profile.ganti.pic');
    Route::get('/profile/email-change', [CoreController::class, 'gantiEmail'])->name('profile.ganti.email');
    Route::get('/profile/pwd-change', [CoreController::class, 'gantiPwd'])->name('profile.ganti.pass');
    Route::get('/complete-profile', [CoreController::class, 'profile'])->name('profile.completation');
    Route::post('/complete-profile', [CoreController::class, 'store'])->name('profile.completation.store');
    Route::get('/profile', [CoreController::class, 'profileInfo'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/auth.php';
