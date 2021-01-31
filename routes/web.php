<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VoosController;

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
//Register Routes


Route::prefix('admin')->group(function(){  
    Route::get('/login', [AdminsController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminsController::class, 'auth'])->name('admin.auth');
    Route::get('/dashboard', [AdminsController::class, 'index'])->name('admin.dashboard');
    Route::get('/logout', [AdminsController::class, 'logout'])->name('admin.logout');
    Route::get('/forgotmypass', [AdminsController::class, 'ForgotPass'])->name('forgot.password');
    Route::post('/forgotmypass', [AdminsController::class, 'dealForgot'])->name('admin.forgot.password');
    Route::get('reset/{admin}', [AdminsController::class, 'FormResetPassword'])->name('form.reset.pass');
    Route::put('reset/{admin}', [AdminsController::class, 'resetPassword'])->name('reset.pass');
});

Route::prefix('user')->group(function(){  
    Route::get('/login', [UsersController::class, 'login'])->name('user.login');
    Route::post('/login', [UsersController::class, 'auth'])->name('user.auth');
    Route::get('/dashboard', [UsersController::class, 'index'])->name('user.dashboard');
    Route::post('/logout', [UsersController::class, 'login'])->name('user.logout');
});

Route::resource('user', UsersController::class);

//Exception, this was a bug
Route::resource('voo', VoosController::class, ['except' => 'destroy'])->middleware('guest');
Route::get('voo/destroy/{voo}', [VoosController::class, 'destroy'])->name('voo.destroy')->middleware('guest');
//


Route::get('all', [VoosController::class, 'all'])->name('voo.all')->middleware('guest');

//Paginas Secundarias
Route::get('/carrinho', function () {

});
Route::get('/minhaconta', function () {

});


//Login Predefinido
//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
