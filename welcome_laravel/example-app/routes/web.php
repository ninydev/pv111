<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('pages.index');
});

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/news', function () {
    return view('pages.news');
});

Route::get('/contact', function () {
    return view('pages.contact');
});


Route::get('/info', function () {
    phpinfo();
});

Route::get('/test', function () {
    \Illuminate\Support\Facades\Log::debug("Hello Test");
    return "Hello Test";
});
