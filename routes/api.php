<?php

use App\Http\Controllers\Api\CareerApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\DoctorApiController;
use App\Http\Controllers\Api\FacilityApiController;
use App\Http\Controllers\Api\GaleryApiController;
use App\Http\Controllers\Api\IdentityApiController;
use App\Http\Controllers\Api\ImageApiController;
use App\Http\Controllers\Api\JadwalApiController;
use App\Http\Controllers\Api\PostApiController;
use App\Http\Controllers\Api\JumbotronApiController;
use App\Http\Controllers\Api\MitraApiController;
use App\Http\Controllers\Api\PelayananApiController;
use App\Http\Controllers\Api\PoliklinikApiController;
use App\Http\Controllers\Api\TimelineApiController;
use App\Http\Controllers\Pages\PoliklinikController;
use Illuminate\Foundation\Mix;
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


Route::get('/categories', [CategoryApiController::class, 'getCategory']);
Route::post('/categories', [CategoryApiController::class, 'store']);
Route::get('/categories/{category}', [CategoryApiController::class, 'show']);
Route::put('/categories/{category}', [CategoryApiController::class, 'update']);

Route::get('/careers', [CareerApiController::class, 'getCareer']);
Route::post('/careers', [CareerApiController::class, 'store']);
Route::get('/careers/{career}', [CareerApiController::class, 'show']);
Route::put('/careers/{career}', [CareerApiController::class, 'update']);

Route::post('/appliers', [CareerApiController::class, 'apply']);

Route::get('/posts', [PostApiController::class, 'getPost']);
Route::post('/posts', [PostApiController::class, 'store']);
Route::get('/posts/{post}', [PostApiController::class, 'show']);
Route::put('/posts/{post}', [PostApiController::class, 'update']);
Route::post('/posts/{post}/activate', [PostApiController::class, 'activate']);
Route::post('/posts/{post}/deactivate', [PostApiController::class, 'deactivate']);

Route::get('/facilities', [FacilityApiController::class, 'getFacility']);
Route::post('/facilities', [FacilityApiController::class, 'store']);
Route::get('/facilities/{facility}', [FacilityApiController::class, 'show']);
Route::put('/facilities/{facility}', [FacilityApiController::class, 'update']);

Route::get('/pelayanan', [PelayananApiController::class, 'getPelayanan']);
Route::post('/pelayanan', [PelayananApiController::class, 'store']);
Route::get('/pelayanan/{pelayanan}', [PelayananApiController::class, 'show']);
Route::put('/pelayanan/{pelayanan}', [PelayananApiController::class, 'update']);

Route::get('/doctors', [DoctorApiController::class, 'getDoctor']);
Route::post('/doctors', [DoctorApiController::class, 'store']);
Route::get('/doctors/{doctor}', [DoctorApiController::class, 'show']);
Route::put('/doctors/{doctor}', [DoctorApiController::class, 'update']);

Route::get('/polikliniks', [PoliklinikApiController::class, 'getPoliklinik']);
Route::post('/polikliniks', [PoliklinikApiController::class, 'store']);
Route::get('/polikliniks/{doctor}', [PoliklinikApiController::class, 'show']);
Route::put('/polikliniks/{doctor}', [PoliklinikApiController::class, 'update']);

Route::get('/mitras', [MitraApiController::class, 'getMitra']);
Route::post('/mitras', [MitraApiController::class, 'store']);
Route::get('/mitras/{mitra}', [MitraApiController::class, 'show']);
Route::put('/mitras/{mitra}', [MitraApiController::class, 'update']);
Route::post('/mitras/{mitra}/activate', [MitraApiController::class, 'activate']);
Route::post('/mitras/{mitra}/deactivate', [MitraApiController::class, 'deactivate']);


Route::get('/timelines', [TimelineApiController::class, 'getTimeline']);
Route::post('/timelines', [TimelineApiController::class, 'store']);
Route::get('/timelines/{timeline}', [TimelineApiController::class, 'show']);
Route::put('/timelines/{timeline}', [TimelineApiController::class, 'update']);

Route::get('/jumbotron', [JumbotronApiController::class, 'show']);
Route::put('/jumbotron/{jumbotron}', [JumbotronApiController::class, 'update']);

Route::get('/jadwal', [JadwalApiController::class, 'show']);
Route::put('/jadwal/{jadwal}', [JadwalApiController::class, 'update']);

Route::get('/identity', [IdentityApiController::class, 'show']);
Route::put('/identity/{identity}', [IdentityApiController::class, 'update']);

Route::get('/galeries', [GaleryApiController::class, 'getGalery']);
Route::post('/galeries', [GaleryApiController::class, 'store']);
Route::get('/galeries/{galery}', [GaleryApiController::class, 'show']);
Route::put('/galeries/{galery}', [GaleryApiController::class, 'update']);
Route::delete('/galeries/{galery}', [GaleryApiController::class, 'destroy']);

Route::get('/images', [ImageApiController::class, 'getGalery']);
Route::post('/images', [ImageApiController::class, 'store']);
Route::get('/images/{image}', [ImageApiController::class, 'show']);
Route::put('/images/{image}', [ImageApiController::class, 'update']);
Route::delete('/images/{image}', [ImageApiController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
