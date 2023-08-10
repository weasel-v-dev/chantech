<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/testimonial/', [TestimonialController::class, 'index']);

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['verified', 'auth']], function () {
    Route::get('/blog', function () {
        return view('blog');
    });
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::post('/distribution', [HomeController::class, 'distribution']);
    Route::post('/testimonial/clean', [TestimonialController::class, 'clean']);
    Route::get('/testimonial/check', [TestimonialController::class, 'check']);
});
//test
