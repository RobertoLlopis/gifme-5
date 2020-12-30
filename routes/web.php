<?php

use App\Http\Controllers\HomeController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/', [HomeController::class, 'index']);
Route::get('/getInfoBack', [HomeController::class, 'getPostsInfo']);

Route::post('/add-comment', [HomeController::class, 'addComment']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

