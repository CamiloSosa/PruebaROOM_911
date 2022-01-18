<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/user/{user_id}/edit', [UserController::class, 'edit'])->middleware(['authAdmin']);
Route::post('/user/{user_id}/', [UserController::class, 'update'])->middleware(['authAdmin']);
Route::get('/user/', [UserController::class, 'create'])->middleware(['authAdmin']);
Route::post('/user/', [UserController::class, 'store'])->middleware(['authAdmin']);


require __DIR__.'/auth.php';
