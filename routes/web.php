<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;

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

//Auth

Route::get('/login', [LoginController::class, 'index']);
Route::get('/logout', [LoginController::class, 'logout'])->name("logout");
Route::post('/login', [LoginController::class, 'login'])->name('login');

//Core
Route::get('/', [HomeController::class, 'index']);
Route::group(['middleware' => 'auth'], function(){
    Route::post("/projects/{project}/tasks", [ProjectTaskController::class, 'create'])->name('tasks.create');
    Route::resource('projects', ProjectController::class);
});