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

Route::match(['post', 'get'],'/', [\App\Http\Controllers\AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout')->middleware('auth:web');

Route::group(['prefix' => '/', 'middleware' => 'auth:web'], function (){
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
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
