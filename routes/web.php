<?php

use App\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\UserController;

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

Route::prefix('admin')->group(function(){
    
    Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('admin.login');
    Route::match(['get', 'post'], '/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'registration'])->name('admin.register');
    Route::middleware('auth:admin')->group(function (){
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/detail/{id}', [UserController::class, 'show'])->name('user.show');
        Route::middleware('can:isSuperAdmin')->group(function(){
            Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
            Route::post('/user/create', [UserController::class, 'store'])->name('user.store');
            Route::get('/user/update/{id}', [UserController::class, 'edit'])->name('user.edit');
            Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
            Route::get('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
        });
    });
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    //'verify' => true
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
