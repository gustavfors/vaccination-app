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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/family', [App\Http\Controllers\FamilyController::class, 'index']);
Route::get('/vaccines', [App\Http\Controllers\VaccineController::class, 'index']);

Route::get('/vaccines/create', [App\Http\Controllers\VaccineController::class, 'create']);
Route::post('/vaccines', [App\Http\Controllers\VaccineController::class, 'store']);
Route::post('/vaccines/edit', [App\Http\Controllers\VaccineController::class, 'edit']);
Route::patch('/vaccines', [App\Http\Controllers\VaccineController::class, 'update']);
Route::delete('/vaccines', [App\Http\Controllers\VaccineController::class, 'destroy']);

Route::post('/profiles', [App\Http\Controllers\ProfileController::class, 'store']);
Route::post('/profiles/edit', [App\Http\Controllers\ProfileController::class, 'edit']);
Route::patch('/profiles', [App\Http\Controllers\ProfileController::class, 'update']);
Route::delete('/profiles', [App\Http\Controllers\ProfileController::class, 'destroy']);

Route::get('/vaccinations/create', [App\Http\Controllers\VaccinationController::class, 'create']);
Route::post('/vaccinations/create', [App\Http\Controllers\VaccinationController::class, 'create']);
Route::post('/vaccinations/edit', [App\Http\Controllers\VaccinationController::class, 'edit']);

Route::post('/vaccinations', [App\Http\Controllers\VaccinationController::class, 'store']);
Route::patch('/vaccinations', [App\Http\Controllers\VaccinationController::class, 'update']);
Route::delete('/vaccinations', [App\Http\Controllers\VaccinationController::class, 'destroy']);
