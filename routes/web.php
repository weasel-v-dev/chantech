<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});



Route::get('/testimonial', [App\Http\Controllers\TestimonialController::class, 'index']);

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['verified', 'auth']], function () {
    Route::get('/blog', function () {
        return view('blog');
    });
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/distribution', [App\Http\Controllers\HomeController::class, 'distribution']);
});

//Route::get('/{any?}', function () {
//    return view('dashboard');
//})->where('any', '.*');
//Route::get('/', function () {
//    return view('welcome');
//})->where('any', '.*');
