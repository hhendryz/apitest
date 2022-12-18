<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\BilanganController;
use App\Http\Controllers\UserController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [AdminController::class, 'index'])->name('admin.index');
Route::get('/bilangan', [BilanganController::class, 'index'])->name('bilangan.index');
Route::post('/bilangan/ubah', [BilanganController::class, 'ubah'])->name('bilangan.ubah');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/bilangan', [App\Http\Controllers\BilanganController::class, 'index'])->name('bilangan');
Route::post('/admin/bilangan/ubah', [BilanganController::class, 'ubah'])->name('bilangan.ubah');
Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::post('/admin/users/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
Route::get('/admin/users/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::patch('/admin/users/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::post('/admin/users/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
Route::post('/admin/users/get', [App\Http\Controllers\UserController::class, 'getUser'])->name('user.get');
Route::get('/admin/api_stocks', [App\Http\Controllers\ApiController::class, 'index'])->name('apistock');
Route::get('/admin/api_users', [App\Http\Controllers\ApiController::class, 'api_user'])->name('apiuser');