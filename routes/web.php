<?php

use App\Http\Controllers\DentistsController;
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

Route::get('/', [DentistsController::class, 'index'])->name('home');
Route::post('/', [DentistsController::class, 'store']);
Route::post('/{dentist_id}/{dentist_name}', [DentistsController::class, 'destroy'])->name('destroy');
Route::get('/edit/{dentist_id}', [DentistsController::class, 'edit'])->name('edit');
Route::post('/edit', [DentistsController::class, 'update']);
