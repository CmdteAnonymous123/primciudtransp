<?php

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

/**ESTO QUITAR CUANDO SE PONGA EN PRODUCCION!!!***/
Route::get('/', function () {
    return redirect('/login');
});
/*************************************************/

Route::get('/encuesta', function () {
    return redirect('/login');
});

require __DIR__.'/auth.php';


use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');
//Route::post('/registro', [AuthController::class, 'register']);
Route::post('/registro', [App\Http\Controllers\Api\RegisterController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
