<?php

use App\Http\Controllers\bussiness\BussinessController;
use App\Http\Controllers\Bussiness\ReviewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
\
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/bussiness', [BussinessController::class, "index"]);
Route::post('/bussiness/store', [BussinessController::class, "store"])->name('bussiness.store');
Route::get('/bussiness/edit/{id}', [BussinessController::class, "edit"]);
Route::put('/bussiness/update/{id}', [BussinessController::class, "update"]);
Route::delete('/bussiness/destroy/{id}', [BussinessController::class, "destroy"]);

Route::get('/reviews/{id}', [ReviewsController::class, "index"]);
