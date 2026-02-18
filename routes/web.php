<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('sensors', SensorController::class);
Route::get('/sensors', [SensorController::class, 'index'])->name('sensors.index');
