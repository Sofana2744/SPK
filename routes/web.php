<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CriteriaController;
//hallo

Route::get("/criteria", [CriteriaController::class,'index']);
Route::post("/criteria", [CriteriaController::class,'store']);

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/kriteria', function () {
    return view('kriteria', ['title' => 'Kriteria']);
});

Route::get('/alternatif', function () {
    return view('alternatif' , ['title' => 'Alternatif']);
});
