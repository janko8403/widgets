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
Route::get('/confirm/{confirmString}', [App\Http\Controllers\FrontendController::class, 'verifyConfirmString'])->name('confirmStringVerification');
Route::get('/', [App\Http\Controllers\FrontendController::class, 'welcome'])->name('welcome');
Route::post('/agecheck', [App\Http\Controllers\FrontendController::class, 'verifyAge'])->name('age');
Route::get('/getInspirations', [App\Http\Controllers\FrontendController::class, 'getInspirations'])->name('inspirations');
Route::get('/getReg', [App\Http\Controllers\FrontendController::class, 'getReg'])->name('reg');
Route::get('/getStart', [App\Http\Controllers\FrontendController::class, 'getStart'])->name('start');
Route::get('/getIdea', [App\Http\Controllers\FrontendController::class, 'getIdea'])->name('idea');
Route::post('/final', [App\Http\Controllers\FrontendController::class, 'getFinal'])->name('final');
Route::get('/thankYou', [App\Http\Controllers\FrontendController::class, 'getThankYou'])->name('thankyou');



Auth::routes([
  'register' => false,
]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/switchPrize', [App\Http\Controllers\HomeController::class, 'switchPrize'])->name('switchPrize');
Route::post('/switchContest', [App\Http\Controllers\HomeController::class, 'switchContest'])->name('switchContest');
// URL::forceScheme('https');
