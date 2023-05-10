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

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['verified', 'auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::post('/position', [App\Http\Controllers\PositionController::class, 'create']);
    Route::post('/company', [App\Http\Controllers\CompanyController::class, 'create']);
    Route::post('/reviewer', [App\Http\Controllers\ReviewerController::class, 'create']);
    Route::post('/employee', [App\Http\Controllers\EmployeeController::class, 'create']);
    Route::post('/review', [App\Http\Controllers\ReviewController::class, 'create']);
});

Route::get('/{any?}', function () {
    return view('dashboard');
})->where('any', '.*');
