<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\BookController;
use App\Http\Controllers\Web\BranchController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\SemesterController;
use Faker\Guesser\Name;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the 'web' middleware group. Make something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', function () {
    return redirect("/");
});

Route::get('/branches', [BranchController::class, 'index'])->name('branches');
Route::get('/branches/{branch}', [BranchController::class, 'show'])->name('branches.show');
Route::get('/branches/{branch}/books', [BranchController::class, 'books'])->name('branches.books');
Route::get('/branches/{branch}/semesters/{semester}/books',
    [BranchController::class, 'semesterBooks']
)->name('branches.semesters.books');

Route::get('/branches/{branch}/semesters/{semester}/books/{book}',
    [BranchController::class, 'showBook']
)->name('branches.semesters.books.show');



Route::get('/books', [BookController::class, 'index'])->name('books');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

