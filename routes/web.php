<?php

use App\Http\Controllers\Pages\CareerController;
use App\Http\Controllers\Pages\FasilitasController;
use App\Http\Controllers\Pages\JadwalDokterController;
use App\Http\Controllers\Pages\JumbotronController;
use App\Http\Controllers\Pages\CategoryController;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\Pages\DoctorController;
use App\Http\Controllers\Pages\FacilityController;
use App\Http\Controllers\Pages\GaleryController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\IdentityController;
use App\Http\Controllers\Pages\JadwalController;
use App\Http\Controllers\Pages\PagePostController;
use App\Http\Controllers\Pages\PelayananController;
use App\Http\Controllers\Pages\UserController;
use App\Http\Controllers\Pages\PostController;
use App\Http\Controllers\Pages\TentangController;
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
Route::get('/jadwal-dokter', [HomeController::class, 'jadwalDokter']);
Route::get('/mitra-kami', [HomeController::class, 'mitraKami']);
Route::get('/faq', [HomeController::class, 'faq']);
Route::get('/about-us', [TentangController::class, 'index']);
Route::get('/jadwal/{dokter:id}', [JadwalDokterController::class, 'show']);
Route::get('/posts', [PagePostController::class, 'index']);
Route::get('/posts/{post:slug}', [PagePostController::class, 'show']);
Route::get('/fasilitas-unggulan', [FasilitasController::class, 'index']);
Route::get('/fasilitas-lainnya', [FasilitasController::class, 'lainnya']);
Route::get('/fasilitas/{fasilitas:slug}', [FasilitasController::class, 'show']);
Route::get('/career', [CareerController::class, 'index']);
Route::get('/career/{tipe}', [CareerController::class, 'career']);
Route::get('/career/{tipe}/{career:id}', [CareerController::class, 'apply']);

Route::middleware('auth')->group(function () {
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

// Route::get('/igd', [HomeController::class, 'igd']);

// Route::get('/rawat-jalan', function () {
//     $about = Identity::first();
//     return view('services.rawat-jalan', [
//         'name' => $about->name,
//         'title' => 'Rawat Jalan',
//         'about' => $about,
//         'pelayanan' => Pelayanan::all()
//     ]);
// });

// Route::get('/rawat-inap', function () {
//     $about = Identity::first();
//     return view('services.rawat-inap', [
//         'name' => $about->name,
//         'title' => 'Rawat Inap',
//         'about' => $about,
//         'pelayanan' => Pelayanan::all()
//     ]);
// });

// Route::get('/radiologi', function () {
//     $about = Identity::first();
//     return view('services.radiologi', [
//         'name' => $about->name,
//         'title' => 'Radiologi',
//         'about' => $about,
//         'pelayanan' => Pelayanan::all()
//     ]);
// });

// Route::get('/laboratorium', function () {
//     $about = Identity::first();
//     return view('services.laboratorium', [
//         'name' => $about->name,
//         'title' => 'Laboratorium',
//         'about' => $about,
//         'pelayanan' => Pelayanan::all()
//     ]);
// });

// Route::get('/perinatologi', function () {
//     $about = Identity::first();
//     return view('services.perinatologi', [
//         'name' => $about->name,
//         'title' => 'Perinatologi',
//         'about' => $about,
//         'pelayanan' => Pelayanan::all()
//     ]);
// });