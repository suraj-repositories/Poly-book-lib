<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['custom_guest'])->group(function(){
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.validate');

    Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.save');

    Route::get('/google-login', [AuthController::class, 'googleLogin'])->name('google.login');
    Route::get('/auth/google/callback', [AuthController::class, 'googleHandler'])->name('googleHandler');

    Route::get('/github-login', [AuthController::class, 'githubLogin'])->name('github.login');
    Route::get('/auth/github/callback', [AuthController::class, 'githubHandler'])->name('github.callback');

    Route::get('/auth/facebook', [AuthController::class, 'facebookPage'])->name('facebook.login');
    Route::get('/auth/facebook/callback', [AuthController::class, 'facebookRedirect'])->name('facebook.callback');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
