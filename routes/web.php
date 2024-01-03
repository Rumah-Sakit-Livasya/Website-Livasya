<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Pages\JumbotronController;
use App\Http\Controllers\Pages\CategoryController;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\Pages\DoctorController;
use App\Http\Controllers\Pages\FacilityController;
use App\Http\Controllers\Pages\UserController;
use App\Http\Controllers\Pages\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->group(function () {
        // Dashboard
        Route::get("/", [DashboardController::class, 'index'])->name("dashboard");

        // Category
        Route::get("/categories", [CategoryController::class, 'index'])->name("category.index");
        Route::get('/categories/checkSlug', [CategoryController::class, 'checkSlug']);

        // Posts
        Route::get("/posts", [PostController::class, 'index'])->name("posts.index");
        Route::get('/posts/checkSlug', [PostController::class, 'checkSlug']);

        // Facility
        Route::get("/facilities", [FacilityController::class, 'index'])->name("facilities.index");
        Route::get('/facilities/checkSlug', [FacilityController::class, 'checkSlug']);

        // Doctor
        Route::get("/doctors", [DoctorController::class, 'index'])->name("doctors.index");

        // Jumbotron
        Route::get("/jumbotron", [JumbotronController::class, 'index'])->name("jumbotron.index");

        // Users
        Route::get("/users", [UserController::class, 'index'])->name("user.index");
        Route::post("/users", [UserController::class, 'store'])->name("user.store");
        Route::put("/users/{users:id}", [UserController::class, 'update'])->name("user.update");
        Route::put('/user/{user:id}/akses', [UserController::class, 'akses'])->name('user.update.role');
        Route::put('/user/{user:id}/update-password', [UserController::class, 'updatePassword'])->name('user.update.password');
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/default-menu.php';
