<?php

use App\Http\Controllers\CartController;
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

Route::match(['post', 'get'], '/', [\App\Http\Controllers\AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout')->middleware('auth:web');
Route::get('/titik-kami', [\App\Http\Controllers\TitikController::class, 'index']);

Route::get('/map/data', [\App\Http\Controllers\MapController::class, 'get_map_json']);
Route::get('/map/data/{id}', [\App\Http\Controllers\MapController::class, 'get_map_by_id']);

Route::get('/cek-map', [\App\Http\Controllers\MapController::class, 'index']);
Route::get('/cek-map/data', [\App\Http\Controllers\MapController::class, 'get_map_json']);
Route::get('/cek-map/data-detail/{id}', [\App\Http\Controllers\MapController::class, 'get_map_by_id']);

Route::post('/add-to-cart', [CartController::class, 'addToCart']);
Route::post('/remove-from-cart', [CartController::class, 'removeFromCart']);
Route::get('/get-cart-items', [CartController::class, 'getCartItems']);


Route::get('/titik/{province}', [\App\Http\Controllers\TitikController::class, 'titikProvince']);
Route::get('/titik-kota/{city}', [\App\Http\Controllers\TitikController::class, 'titikCity']);
Route::get('/titik-kami/listing/{slug}', [\App\Http\Controllers\TitikController::class, 'detail']);
Route::get('/titik/{prvince}/{city}', function () {
    return view('user.titik_per_kota');
});


Route::prefix('data')->group(
    function () {
        Route::get('province', [\App\Http\Controllers\ProvinceController::class, 'province']);
        Route::get('province/{id}/city', [\App\Http\Controllers\ProvinceController::class, 'city']);
        Route::get('city', [\App\Http\Controllers\ProvinceController::class, 'cityAll']);
        Route::get('type', [\App\Http\Controllers\ItemController::class, 'getType']);
        Route::prefix('item')->group(
            function () {
                Route::get('datatable', [\App\Http\Controllers\ItemController::class, 'datatable']);
                Route::get('card', [\App\Http\Controllers\ItemController::class, 'cardItem']);
                Route::post('delete/{id}', [\App\Http\Controllers\ItemController::class, 'delete']);
                Route::post('post-item', [\App\Http\Controllers\ItemController::class, 'postItem']);
                Route::get('url-street-view/{id}', [\App\Http\Controllers\ItemController::class, 'getUrlStreetView']);
                Route::get('by-id/{id}', [\App\Http\Controllers\ItemController::class, 'getItemByID']);
                Route::post('show-data', [\App\Http\Controllers\ItemController::class, 'changeShowLandingPage']);
                Route::get('generate-slug', [\App\Http\Controllers\ItemController::class, 'generateSlug']);
            }
        );
    }
);

Route::group(['prefix' => '/', 'middleware' => 'auth:web'], function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::group(['prefix' => 'titik-iklan'], function () {
        Route::get('/', [\App\Http\Controllers\ItemController::class, 'index'])->name('item');
        Route::match(['post', 'get'], '/{id}', [\App\Http\Controllers\ItemController::class, 'getDataByID'])->name('item.by.id');
    });

    Route::match(['post', 'get'], '/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
});
