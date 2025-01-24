<?php

use App\Http\Controllers\CoreController;
use App\Http\Controllers\DataDiriController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [CoreController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('datadiri', DataDiriController::class);
    Route::post('/datadiri', [CoreController::class, 'storeProfilePic'])->name('profile.ganti.pic');
    Route::get('/profile/email-change', [CoreController::class, 'gantiEmail'])->name('profile.ganti.email');
    Route::get('/profile/pwd-change', [CoreController::class, 'gantiPwd'])->name('profile.ganti.pass');
    Route::get('/complete-profile', [CoreController::class, 'profile'])->name('profile.completation');
    Route::post('/complete-profile', [CoreController::class, 'store'])->name('profile.completation.store');
    Route::get('/profile', [CoreController::class, 'profileInfo'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/auth.php';
