<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});


Route::get('/admin/datatitik', function () {
    return view('admin.datatitik');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/admin/profile', function () {
    return view('admin.profile');
});
