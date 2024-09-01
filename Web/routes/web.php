<?php

use App\Http\Controllers\ControllerPertemuan1;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/isiSidebar')->name('Pertemuan1.')->group(function () {
    Route::get('/fibonacci', [ControllerPertemuan1::class, 'calculateFibonacci'])->name('fibonacci');
    Route::get('/ganjil-genap', [ControllerPertemuan1::class, 'checkOddEven'])->name('ganjil-genap');
    Route::get('/prima', [ControllerPertemuan1::class, 'checkPrime'])->name('prima');
    
    // Rute baru untuk parameter form
    Route::get('/parameter-form', [ControllerPertemuan1::class, 'showParameterForm'])->name('parameter-form');
    Route::post('/handle-single-parameter', [ControllerPertemuan1::class, 'handleSingleParameter'])->name('handle-single-parameter');
    Route::post('/handle-double-parameter', [ControllerPertemuan1::class, 'handleDoubleParameter'])->name('handle-double-parameter');
    Route::get('/{param1}', [ControllerPertemuan1::class, 'showSingleParameterPage'])->name('single-parameter');
    Route::get('/{param1}/{param2}', [ControllerPertemuan1::class, 'showDoubleParameterPage'])->name('double-parameter');
});

Route::fallback(function () {
    return view('fallback');
});
