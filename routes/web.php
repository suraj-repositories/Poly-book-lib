<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\BookController;
use App\Http\Controllers\Web\BranchController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\DownloadController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\MaintainenceController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\ReviewController;
use App\Http\Controllers\Web\SemesterController;
use App\Http\Controllers\Web\SubscriberController;
use App\Mail\RegistrationMail;
use Faker\Guesser\Name;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Mail;
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

Route::get('/donwload/{type}/{id}', [DownloadController::class, 'download'])->name('download');
// Route::post('/books/{book}/downloads', [BookController::class, 'downloadBook'])->middleware('guest_download')->name('books.download');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

Route::post('/subscriber/store', [SubscriberController::class, 'store'])->name('subscriber.store');

Route::middleware('auth')->group(function(){
    Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/{user}/update-image', [ProfileController::class, 'updateProfileImage'])->name('profile.image_update');

    Route::post('/books/{book}/review', [ReviewController::class, 'store'])->name('books.review.store');
    Route::delete('/books/{book}/review/{review}', [ReviewController::class, 'destroy'])->name('books.review.delete');
});

Route::get('/under-maintainence', [MaintainenceController::class, 'index'])->name('web.under_maintainence');
