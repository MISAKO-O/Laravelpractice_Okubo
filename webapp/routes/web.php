<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\database\migrations;

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


Route::get('/index', [PostsController::class, 'index']);
Route::get('/show', [PostsController::class, 'show']);
Route::get('/posts', [migrations::class, 'posts']);
Route::get('/authors', [migrations::class, 'authors']);