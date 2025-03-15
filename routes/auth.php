<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialMediaLoginController;
use Illuminate\Support\Facades\Route;

Route::middleware(['custom_guest'])->group(function(){
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.validate');

    Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.save');

    Route::get('/google-login', [SocialMediaLoginController::class, 'googleLogin'])->name('google.login');
    Route::get('/auth/google/callback', [SocialMediaLoginController::class, 'googleHandler'])->name('googleHandler');

    Route::get('/github-login', [SocialMediaLoginController::class, 'githubLogin'])->name('github.login');
    Route::get('/auth/github/callback', [SocialMediaLoginController::class, 'githubHandler'])->name('github.callback');

    Route::get('/auth/facebook', [SocialMediaLoginController::class, 'facebookPage'])->name('facebook.login');
    Route::get('/auth/facebook/callback', [SocialMediaLoginController::class, 'facebookRedirect'])->name('facebook.callback');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


});



Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
