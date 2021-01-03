<?php

use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PapelController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteGroup;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [ChamadoController::class, 'index']);

    Route::group(['prefix' => 'chamado'], function () {
        Route::get('/novo', [ChamadoController::class, 'create']);
        Route::post('/novo', [ChamadoController::class, 'store']);
    
        Route::get('/mostrar/{id}', [ChamadoController::class, 'show']);
    });

    Route::resource('users', UserController::class);

    Route::get('users/papel/{id}', [UserController::class, 'papel'])->name('users.papel');
    Route::post('users/papel/{papel}', [UserController::class, 'papelStore'])->name('users.papel.store');
    Route::delete('users/papel/{user}/{papel}', [UserController::class, 'papelDestroy'])->name('users.papel.destroy');

    Route::resource('papeis', PapelController::class);
    
    Route::get('papeis/permissao/{id}', [PapelController::class, 'permissao'])->name('papeis.permissao');
    Route::post('papeis/permissao/{permissao}', [PapelController::class, 'permissaoStore'])->name('papeis.permissao.store');
    Route::delete('papeis/permissao/{papel}/{permissao}', [PapelController::class, 'permissaoDestroy'])->name('papeis.permissao.destroy');

});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});


