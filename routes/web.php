<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\ReadingController;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\StatisticsController;

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



// Ruta para obtener el número de estudios leídos por cada radiólogo y el tiempo promedio
Route::get('/statistics/readings', [StatisticsController::class, 'getReadingsByRadiologist']);

// Ruta para obtener la intensidad media y volúmenes para un rango de edad y valor de BIRADS
Route::get('/statistics/studies', [StatisticsController::class, 'getStudiesStatistics']);



Route::get('/', function () {
    return view('home');
}); 
Route::get('/studies', [StudyController::class, 'index'])->name('studies.index');
Route::post('/readings', [ReadingController::class, 'store'])->name('readings.store');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
