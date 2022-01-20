<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Room911Controller;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['authAdmin'])->name('dashboard');

Route::get('/access-room', [Room911Controller::class, 'index'])->middleware(['auth']);
Route::get('/room911', [Room911Controller::class, 'room'])->middleware(['auth']);
Route::post('/access-room', [Room911Controller::class, 'access'])->middleware(['auth']);
Route::get('/room-logout', [Room911Controller::class, 'getOut'])->middleware(['auth']);
Route::get('/operator', [HomeController::class, 'operator'])->middleware(['auth']);

Route::middleware(['authAdmin'])->group(function(){
    Route::get('/user/{user_id}/edit', [UserController::class, 'edit']);
    Route::post('/user/{user_id}/', [UserController::class, 'update']);
    Route::get('/user/', [UserController::class, 'create']);
    Route::post('/user/', [UserController::class, 'store']);
    Route::post('/user/{user_id}/allow-access', [UserController::class, 'allowAccess']);
    Route::get('/export/{user_id}', [HomeController::class, 'accessExport']);
});


require __DIR__.'/auth.php';
