<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BenhnhanController;
use App\Http\Controllers\HsbaController;
use App\Http\Controllers\BacsiController;
use App\Http\Controllers\CtbaController;
use App\Http\Controllers\HoadonController;
use App\Http\Controllers\BenhlyController;
use App\Http\Controllers\CanlamsangController;



Route::post('/ctba', [CtbaController::class, 'store']);
Route::put('/ctba/{maba}/{mabl}', [CtbaController::class, 'update']);
Route::delete('/ctba/{maba}/{mabl}', [CtbaController::class, 'destroy']);
Route::get('/benhly/{maba}', [BenhlyController::class, 'getTenbl']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/benhnhan', [BenhnhanController::class, 'index']);
Route::post('/benhnhan', [BenhnhanController::class, 'store']);
Route::get('/benhnhan/{mabn}', [BenhnhanController::class, 'show']);
Route::put('/benhnhan/{mabn}', [BenhnhanController::class, 'update']);
Route::delete('/benhnhan/{mabn}', [BenhnhanController::class, 'destroy']);

Route::get('/hsba', [HsbaController::class, 'index']);
Route::post('/hsba', [HsbaController::class, 'store']);
Route::get('/hsba/{mabn}/{maba}', [HsbaController::class, 'show']);
Route::put('/hsba/{mabn}/{maba}', [HsbaController::class, 'update']);
Route::delete('/hsba/{mabn}/{maba}', [HsbaController::class, 'destroy']);

Route::get('/doctors', [BacsiController::class, 'index']);
Route::post('/doctors', [BacsiController::class, 'store']);
Route::get('/doctors/{id}', [BacsiController::class, 'show']);
Route::put('/doctors/{id}', [BacsiController::class, 'update']);    
Route::delete('/doctors/{id}', [BacsiController::class, 'destroy']);

Route::get('/ctcls/details/{maba}', [CtclsController::class, 'getCtclsDetails']);
Route::post('/ctcls', [CtclsController::class, 'createCtcls']);
Route::put('/ctcls/{maba}/{mapcn}', [CtclsController::class, 'updateCtcls']);
Route::delete('/ctcls/{maba}/{mapcn}', [CtclsController::class, 'deleteCtcls']);

Route::controller(CtnhapvienController::class)->group(function () {
Route::post('/ctnhapvien', 'store'); // Thêm
Route::delete('/ctnhapvien/{maba}/{mapb}', 'destroy'); // Xóa
Route::put('/ctnhapvien/{maba}/{mapb}', 'update'); // Sửa
Route::get('/ctnhapvien/details/{maba}', 'showDetails'); // Hiển thị chi tiết
});

Route::get('/', [CtkhambenhController::class, 'index']);
Route::get('/{makb}', [CtkhambenhController::class, 'show']);
Route::post('/create-and-count', [CtkhambenhController::class, 'createAndCount']);
Route::put('/{makb}', [CtkhambenhController::class, 'update']);
Route::delete('/{makb}', [CtkhambenhController::class, 'destroy']);
Route::get('/mabn/{mabn}', [CtkhambenhController::class, 'getByMabn']);

Route::get('/benhly', [BenhLyController::class, 'index']);
Route::post('/benhly', [BenhLyController::class, 'store']);         // Thêm mới bệnh lý
Route::get('/benhly/{id}', [BenhLyController::class, 'show']);      // Lấy chi tiết bệnh lý
Route::put('/benhly/{id}', [BenhLyController::class, 'update']);    // Cập nhật bệnh lý
Route::delete('/benhly/{id}', [BenhLyController::class, 'destroy']); 

Route::get('/canls', [CanLSController::class, 'index']);          // Lấy danh sách cận lâm sàng
Route::post('/canls', [CanLSController::class, 'store']);         // Thêm mới cận lâm sàng
Route::get('/canls/{id}', [CanLSController::class, 'show']);      // Lấy chi tiết cận lâm sàng
Route::put('/canls/{id}', [CanLSController::class, 'update']);    // Cập nhật cận lâm sàng
Route::delete('/canls/{id}', [CanLSController::class, 'destroy']);
