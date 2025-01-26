<?php

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Api\Admin\BookController as AdminBookController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/branches', [BranchController::class, 'index'])->name('admin.branches');
Route::post('/branches', [BranchController::class, 'store'])->name('admin.branches.store');
Route::delete('/branches/{branch}', [BranchController::class, 'destroy'])->name('admin.branches.destroy');
Route::post('/branches/edit/{branch}', [BranchController::class, 'update'])->name('admin.branches.update');

Route::get('/semesters', [SemesterController::class, 'index'])->name('admin.semesters');
Route::post('/semesters', [SemesterController::class, 'store'])->name('admin.semesters.store');
Route::post('/semesters/edit/{semester}', [SemesterController::class, 'update'])->name('admin.semesters.update');
Route::delete('/semesters/{semester}', [SemesterController::class, 'destroy'])->name('admin.semesters.destroy');
Route::get('/semesters/fetch', [SemesterController::class, 'fetchSemesters'])->name('admin.semesters.fetch');

Route::get('/books', [BookController::class, 'index'])->name('admin.books');
Route::get('/books/create', [BookController::class, 'create'])->name('admin.books.create');
Route::get('/books/select-from-files', [BookController::class, 'selectFromFiles'])->name('admin.books.select.files');

Route::get('/files', [FileController::class, 'index'])->name('admin.files');
Route::get('/files/create', [FileController::class, 'create'])->name('admin.files.create');
Route::post('/files/store', [FileController::class, 'store'])->name('admin.files.store');
Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('admin.files.destroy');
Route::get('/files/upload/status', [FileController::class, 'uploadStatus'])->name('admin.file.upload.status');
Route::post('/files/upload', [FileController::class, 'uploadChunk'])->name('admin.files.upload.chunk');
Route::post('/files/upload/cancel', [FileController::class, 'cancelUpload'])->name('admin.files.upload.cancel');
Route::get('/document/preview/{type}', [FileController::class, 'documentPreview'])->name('admin.files.document.preview');
