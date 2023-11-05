<?php

use App\Models\Event;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;

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
    return view('home.index',[
        'events'=>Event::get()
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard')->middleware('auth');

Route::get('/login', function () {
    return view('user.login');
})->name('login')->middleware('guest');

Route::post('login',[UserController::class,'authLogin'])->middleware('guest');
Route::get('logout',[UserController::class, 'authLogout'])->middleware('auth');

Route::resource('event', EventController::class)->except(['show'])->middleware('auth');
Route::resource('participant', ParticipantController::class)->except(['edit','update'])->middleware('auth');

