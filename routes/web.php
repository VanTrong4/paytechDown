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

Route::get('/', function () { return view('top/home'); })->name('home');
Route::get('/privacy-policy', function () { return view('top/privacy-policy'); })->name('privacy-policy');
Route::get('/thanks', function () { return view('top/thanks'); })->name('thanks');

Route::get('/contact', function () { return view('top/contact'); })->name('contact');
Route::post('/contact', [App\Http\Controllers\PageController::class, 'gotoContact'] )->name('gotoContact');
Route::post('/submit', [App\Http\Controllers\PageController::class, 'submit'] )->name('submit');