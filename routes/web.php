<?php

use App\Http\Controllers\Pages\CareerController;
use App\Http\Controllers\Pages\FasilitasController;
use App\Http\Controllers\Pages\JadwalDokterController;
use App\Http\Controllers\Pages\JumbotronController;
use App\Http\Controllers\Pages\CategoryController;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\Pages\DoctorController;
use App\Http\Controllers\Pages\FacilityController;
use App\Http\Controllers\Pages\FaqController;
use App\Http\Controllers\Pages\GaleryController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\IdentityController;
use App\Http\Controllers\Pages\JadwalController;
use App\Http\Controllers\Pages\MitraController;
use App\Http\Controllers\Pages\PagePelayananController;
use App\Http\Controllers\Pages\PagePostController;
use App\Http\Controllers\Pages\PelayananController;
use App\Http\Controllers\Pages\PoliklinikController;
use App\Http\Controllers\Pages\UserController;
use App\Http\Controllers\Pages\PostController;
use App\Http\Controllers\Pages\TentangController;
use App\Http\Controllers\Pages\TimelineController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/service/{pelayanan:slug}', [HomeController::class, 'index']);
Route::get('/categories', [HomeController::class, 'categories']);
Route::get('/categories/{category:slug}', [HomeController::class, 'category']);
Route::get('/gallery', [HomeController::class, 'gallery']);
Route::get('/dokter', [HomeController::class, 'dokter']);
Route::get('/dokter/{dokter:id}', [HomeController::class, 'detailDokter']);
Route::get('/jadwal-dokter', [HomeController::class, 'jadwalDokter']);
Route::get('/mitra-kami', [HomeController::class, 'mitraKami']);
Route::get('/kebijakan-privasi', [HomeController::class, 'kebijakanPrivasi']);
Route::get('/syarat-ketentuan', [HomeController::class, 'syaratKetentuan']);
Route::get('/faq', [HomeController::class, 'faq']);
Route::get('/about-us', [TentangController::class, 'index']);
Route::get('/posts', [PagePostController::class, 'index']);
Route::get('/posts/{post:slug}', [PagePostController::class, 'show']);
Route::get('/fasilitas-unggulan', [FasilitasController::class, 'index']);
Route::get('/fasilitas-lainnya', [FasilitasController::class, 'lainnya']);
Route::get('/fasilitas/{fasilitas:slug}', [FasilitasController::class, 'show']);
Route::get('/career', [CareerController::class, 'index']);
Route::get('/career/{tipe}', [CareerController::class, 'career']);
Route::get('/career/{tipe}/{career:id}', [CareerController::class, 'apply']);

Route::get('/pelayanan/{pelayanan:slug}', [PagePelayananController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/careers/{career:id}', [CareerController::class, 'appliers']);
    Route::get('/careers/{career:id}/{applier:id}', [CareerController::class, 'applier']);
    Route::get('/careers/{career:id}/{applier:id}/download-cv', [CareerController::class, 'downloadCV']);
    Route::prefix('dashboard')->group(function () {
        // Dashboard
        Route::get("/", [DashboardController::class, 'index'])->name("dashboard");

        // Category
        Route::get("/categories", [CategoryController::class, 'index'])->name("category.index");
        Route::get('/categories/checkSlug', [CategoryController::class, 'checkSlug']);

        // Career
        Route::get("/careers", [CareerController::class, 'admin'])->name("career.index");

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

        // Pelayanan
        Route::get("/pelayanan", [PelayananController::class, 'index'])->name("pelayanan.index");
        Route::get("/pelayanan/{pelayanan:id}/images", [PelayananController::class, 'images'])->name("pelayanan.image");

        // Timeline
        Route::get("/timeline", [TimelineController::class, 'index'])->name("timeline.index");

        // Poliklinik
        Route::get("/poliklinik", [PoliklinikController::class, 'index'])->name("poliklinik.index");

        // Mitra
        Route::get("/mitra", [MitraController::class, 'index'])->name("mitra.index");

        // Faq
        Route::get("/faq", [FaqController::class, 'index'])->name("faq.index");

        // Identity
        Route::get("/identity", [IdentityController::class, 'index'])->name("identity.index");

        // Galery
        Route::get("/galery", [GaleryController::class, 'index'])->name("galery.index");

        // Jadwal
        Route::get("/jadwal", [JadwalController::class, 'index'])->name("jadwal.index");

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
