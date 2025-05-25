<?php

require __DIR__.'/auth.php';
use Illuminate\Support\Facades\Route;
use App\Models\Image;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get("/profile/{id}", [App\Http\Controllers\UserController::class, 'info'])->name('profile.info');
    Route::get('/config', [App\Http\Controllers\UserController::class, 'config'])->name('user.config');
    Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::get('/userAvatar/{fileName}', [App\Http\Controllers\UserController::class, 'getImage'])->name('user.getImage');
    Route::get("/avatar/default", [App\Http\Controllers\UserController::class, 'getDefaultAvatar'])->name('user.getDefaultAvatar');
    Route::get("/img/Form", [App\Http\Controllers\ImageController::class, 'imgForm'])->name('img.form');
    Route::post("/img/up", [App\Http\Controllers\ImageController::class, 'upload'])->name('img.upload');
    Route::get("/img/show/all", [App\Http\Controllers\ImageController::class,'show_all'])->name('img.show_all');
    Route::get("/img/details/{id_img}", [App\Http\Controllers\ImageController::class, 'show_details'])->name('img.details');
    Route::post("/comment/register", [App\Http\Controllers\CommentController::class, 'register'])->name('comment.register');
    Route::get("/comment/delete/{id}", [App\Http\Controllers\CommentController::class, 'delete'])->name('comment.delete');
    Route::get("/like/{id}", [App\Http\Controllers\LikesController::class, 'like'])->name('like');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
