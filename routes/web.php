<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NodeController;
use App\Livewire\NodeList;
use App\Livewire\Register;
use App\Livewire\Login;

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

Route::get('/', function () {return view('default');})->name('home')->middleware('auth');
Route::get('/audios', function () {return view('default');})->name('home')->middleware('auth');

Route::get('/register' , function () {return view('gest');} )->name("register");
Route::get('/login' , function () {return view('gest');} )->name("login");
