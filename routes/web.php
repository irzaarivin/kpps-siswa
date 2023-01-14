<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KppsController;


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

Route::get('/', [KppsController::class, 'index'])->middleware('auth');
Route::get('/home', [KppsController::class, 'index'])->middleware('auth');
Route::get('/home/', [KppsController::class, 'index'])->middleware('auth');

Route::post('/', [KppsController::class, 'store'])->middleware('auth');
Route::post('/home', [KppsController::class, 'store'])->middleware('auth');
Route::post('/home/', [KppsController::class, 'store'])->middleware('auth');

Route::get('/login', [KppsController::class, 'authenticate'])->name('login')->middleware('guest');
Route::get('/login/', [KppsController::class, 'authenticate'])->name('login')->middleware('guest');

Route::post('/login', [KppsController::class, 'login']);
Route::post('/login/', [KppsController::class, 'login']);

Route::post('/register', [KppsController::class, 'register']);
Route::post('/register/', [KppsController::class, 'register']);

Route::post('/simpanDataDiri', [KppsController::class, 'simpanDataDiri']);
Route::post('/simpanDataWali', [KppsController::class, 'simpanDataWali']);

Route::get('/logout', [KppsController::class, 'logout']);