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
Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [PostsController::class, 'index'])->name('index');
Route::get('/create', [PostsController::class, 'showCreate'])->name('show.create');
Route::post('/create', [PostsController::class, 'storePost'])->name('store.post');
Route::get('/edit/{id}', [PostsController::class, 'showEdit'])->name('show.edit');
Route::post('/edit/{id}', [PostsController::class, 'registEdit'])->name('regist.edit');
Route::delete('/delete/{id}', [PostsController::class, 'deletePost'])->name('delete');

#Route::get('/show', [PostsController::class, 'show']);
#Route::get('/posts', [migrations::class, 'posts']);
#Route::get('/authors', [migrations::class, 'authors']);