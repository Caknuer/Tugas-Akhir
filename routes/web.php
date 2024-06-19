<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\mahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('mahasiswa', mahasiswaController::class)->middleware('auth');

Route::middleware('guest')->group(function() {
});
Route::get('/sesi',[loginController::class,'index'])->name('login');
Route::post('/sesi/login',[loginController::class,'login']);
Route::get('/sesi/logout',[loginController::class,'logout']);
Route::get('/sesi/register',[loginController::class,'register']);
Route::post('/sesi/create',[loginController::class,'create']);
