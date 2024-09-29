<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RecycleController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::group(['middleware'=>'auth'], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //--Project [start]--//
    Route::get('/projectList', [ProjectController::class, 'projectList'])->name('projectList');
    Route::post('/projectAdd', [ProjectController::class, 'projectAdd'])->name('projectAdd');
    Route::get('/projectEdit/{id}', [ProjectController::class, 'projectEdit'])->name('projectEdit');
    Route::post('/projectUpdate', [ProjectController::class, 'projectUpdate'])->name('projectUpdate');
    Route::get('/projectDelete/{id}', [ProjectController::class, 'projectDelete'])->name('projectDelete');
    //--Project [end]--//

    //--Recycle [start]--//
    Route::get('/recycleProjectList', [RecycleController::class, 'recycleProjectList'])->name('recycleProjectList');
    Route::get('/projectRestore/{id}', [RecycleController::class, 'projectRestore'])->name('projectRestore');
    //--Recycle [end]--//


    Route::get('/test', [HomeController::class, 'test'])->name('test');
    Route::get('/sendmail', [HomeController::class, 'sendmail'])->name('sendmail');
});