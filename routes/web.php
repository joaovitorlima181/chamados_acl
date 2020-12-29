<?php

use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::group(['prefix' => 'login'], function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'login']);
});

Route::group(['prefix' => 'registrar'], function () {
    Route::get('/', [RegisterController::class, 'create']);
    Route::post('/', [RegisterController::class, 'store']);
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', [ChamadoController::class, 'index']);

    Route::get('/novo', [ChamadoController::class, 'create']);
    Route::post('/novo', [ChamadoController::class, 'store']);

    Route::get('/mostrar/{id}', [ChamadoController::class, 'show']);
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});


