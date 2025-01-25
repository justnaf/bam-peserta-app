<?php

use App\Http\Controllers\AchieveController;
use App\Http\Controllers\CoreController;
use App\Http\Controllers\DataDiriController;
use App\Http\Controllers\EduController;
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


    // Profile Route
    Route::resource('datadiri', DataDiriController::class); // Data Diri Resource
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
