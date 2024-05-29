<?php

use App\Http\Controllers\AlternativeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CriteriaController;

Route::get('/criteria', [CriteriaController::class,'index'] );
Route::post('/criteria', [CriteriaController::class,'store'] );
Route::patch('/criteria/{id}', [CriteriaController::class, 'update'] );
Route::delete('/criteria/{id}', [CriteriaController::class, 'destroy'] );

Route::get('/alternative', [AlternativeController::class,'index'] );
Route::post('/alternative', [AlternativeController::class,'store'] );
Route::patch('/alternative/{id}', [AlternativeController::class, 'update'] );
Route::delete('/alternative/{id}', [AlternativeController::class, 'destroy'] );

Route::get('matrix', [CriteriaController::class,'matrix'] );
Route::post('/matrix/proses', [CriteriaController::class,'prosesMatrix'] );





Route::get('/', function () {
    return view('home', ['title' => 'Home']);
});

Route::get('/kriteria', function () {
    return view('kriteria', ['title' => 'Kriteria']);
});

Route::get('/alternatif', function () {
    return view('alternatif' , ['title' => 'Alternatif']);
});
Route::get('/hasil', function () {
    return view('hasil' , ['title' => 'hasil']);
});
