<?php

use Illuminate\Support\Facades\Route;
//hallo
Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/kriteria', function () {
    return view('kriteria', ['title' => 'Kriteria']);
});

Route::get('/alternatif', function () {
    return view('alternatif' , ['title' => 'Alternatif']);
});
