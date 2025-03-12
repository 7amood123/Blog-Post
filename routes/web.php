<?php

use App\Http\Controllers\Page\AdminPostController;
use App\Http\Controllers\Page\VerificationController;
use App\Http\Controllers\Posts\CategoryController;
use App\Http\Controllers\Page\HomeController;
use App\Http\Controllers\Page\NewsletterController;
use App\Http\Controllers\Posts\PostCommentsController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\SessionsController as ControllersSessionsController;
use App\Http\Controllers\User\ProfilesController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\SessionsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::put('edit', [AdminPostController::class, 'edit']);
Route::post('edit', [AdminPostController::class, 'update'])->middleware('admin')->name('posts.update');

Route::post('newsletter', NewsletterController::class);

Route::get('create', [PostController::class, 'create'])->middleware('auth');
Route::post('create', [PostController::class, 'store'])->middleware('auth');

Route::get('create-category', [CategoryController::class, 'create'])->middleware('auth');
Route::post('create-category', [CategoryController::class, 'store'])->middleware('auth');

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

// Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
// Route::post('loginn', [SessionsController::class, 'login'])->middleware('auth');

Route::post('logout', [ControllersSessionsController::class, 'destroy'])->middleware('auth');

// Admin Section
Route::middleware('can:admin')->group(function () {
    Route::resource('admin/posts', AdminPostController::class)->except('show');
});

//Route::middleware('can:user')->group(function () {
//    Route::resource('user/posts', AdminPostController::class)->except("show");
//});

Route::get('user/posts', [AdminPostController::class, 'index']);

Route::get('profiles', [ProfilesController::class, 'show'])->name('show');
Route::post('profiles', [ProfilesController::class, 'update'])->middleware('auth')->name('profiles.update');

// email verification
Auth::routes([
    'verify' => true
]);
Route::get('/verify', [HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/verify', [VerificationController::class, 'resend'])->name('verification.resend');



