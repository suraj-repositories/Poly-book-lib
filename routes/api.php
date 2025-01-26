<?php

use App\Http\Controllers\Api\Admin\BranchController;
use App\Http\Controllers\Api\Admin\SemesterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['web', 'admin'])->group(function(){
    Route::get('/branches/fetch', [BranchController::class, 'fetchBranches'])->name('api.fetch.branches');

    Route::get('/semesters/fetch', [SemesterController::class, 'fetchSemesters'])->name('api.fetch.semesters');

});

