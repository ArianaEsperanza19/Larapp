<?php

require __DIR__.'/auth.php';
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Usuario
    Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');
    Route::get("/profile/{id}", [App\Http\Controllers\UserController::class, 'info'])->name('profile.info');
    Route::get('/config', [App\Http\Controllers\UserController::class, 'config'])->name('user.config');
    Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::get('/user/index/{search?}', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('/userAvatar/{fileName}', [App\Http\Controllers\UserController::class, 'getAvatar'])->name('user.getImage');
    Route::get("/avatar/default", [App\Http\Controllers\UserController::class, 'getDefaultAvatar'])->name('user.getDefaultAvatar');
    // Profile
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    // Imagenes
    Route::get('/miniatura/{fileName}', [App\Http\Controllers\ImageController::class, 'miniatura'])->name('img.miniatura');
    Route::get("/img/form/up", [App\Http\Controllers\ImageController::class, 'imgForm'])->name('img.form.up');
    Route::post("/img/up", [App\Http\Controllers\ImageController::class, 'upload'])->name('img.upload');
    Route::get("/img/down/{id_img}/{id_user}", [App\Http\Controllers\ImageController::class, 'delete'])->name('img.delete');
    Route::get("img/form/edit/{id_img}", [App\Http\Controllers\ImageController::class, 'form_edit'])->name('img.form.edit');
    Route::post("img/edit", [App\Http\Controllers\ImageController::class, 'edit'])->name('img.edit');
    Route::get("/img/show/all", [App\Http\Controllers\ImageController::class,'show_all'])->name('img.show_all');
    Route::get("/img/details/{id_img}", [App\Http\Controllers\ImageController::class, 'show_details'])->name('img.details');
    // Comentarios
    Route::post("/comment/register", [App\Http\Controllers\CommentController::class, 'register'])->name('comment.register');
    Route::get("/comment/delete/{id}", [App\Http\Controllers\CommentController::class, 'delete'])->name('comment.delete');
    // Likes
    Route::get("/like/{id}", [App\Http\Controllers\LikesController::class, 'like'])->name('like');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
