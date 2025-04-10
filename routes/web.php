<?php

use App\Http\Controllers\AkreditasiController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\GreetingController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\KelompokKeahlianController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfilLulusanController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\VisiMisiController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');
Route::get('/about', [LandingPageController::class, 'about'])->name('landing.about');
Route::get('/visi-misi', [LandingPageController::class, 'visiMisi'])->name('landing.visiMisi');
Route::get('/dosen', [LandingPageController::class, 'dosen'])->name('landing.dosen');
Route::get('/profil-lulusan', [LandingPageController::class, 'profilLulusan'])->name('landing.profilLulusan');
Route::get('/mata-kuliah', [LandingPageController::class, 'mataKuliah'])->name('landing.mataKuliah');
Route::get('/kelompok-keahlian/{id}', [LandingPageController::class, 'kelompokKeahlian'])->name('landing.kelompokKeahlian');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    // Crud category post
    Route::group(['prefix' => '/administrator'], function(){
        Route::resource('/category', CategoryController::class);
        Route::resource('/post', PostController::class);
        Route::get('/data-posts', [PostController::class, 'dataPost'])->name('post.data');
        Route::resource('/labs', LabController::class);
        Route::resource('/kelompok-keahlian', KelompokKeahlianController::class);
        Route::resource('/dosen', DosenController::class);
        Route::get('/data-dosen', [DosenController::class, 'dataDosen'])->name('dosen.data');
        Route::resource('/banner', BannerController::class);
        Route::resource('/testimonials', TestimonialController::class);
        Route::resource('/greetings', GreetingController::class);
        Route::resource('features', FeatureController::class);
        Route::resource('/histories', HistoryController::class);
        Route::resource('/kaprodi', KaprodiController::class);
        Route::resource('/visi-misi', VisiMisiController::class);
        Route::resource('/struktur-organisasi', StrukturOrganisasiController::class);
        Route::resource('/akreditasi', AkreditasiController::class);
        Route::resource('/matkul', MatkulController::class);
        Route::resource('/profil-lulusan', ProfilLulusanController::class);
    });
});
