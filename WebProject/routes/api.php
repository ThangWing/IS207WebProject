<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BenhnhanController;
use App\Http\Controllers\HsbaController;
use App\Http\Controllers\CtclsController;
use App\Http\Controllers\BacsiController;
use App\Http\Controllers\CtbaController;
use App\Http\Controllers\CtnhapvienController;
use App\Http\Controllers\BenhlyController;
use App\Http\Controllers\CanlamsangController;
use App\Http\Controllers\thuocController;
use App\Http\Controllers\HoadonController;
use App\Http\Controllers\CtkhambenhController;
use App\Http\Controllers\BhytController;
use App\Http\Controllers\LichlamviecController;

Route::get('/lichlamviec', [LichlamviecController::class, 'index']);
Route::post('/lichlamviec', [LichlamviecController::class, 'store']);
Route::get('/lichlamviec/{mabs}/{mapk}/{ngaylamviec}/{calamviec}', [LichlamviecController::class, 'show']);
Route::put('/lichlamviec/{mabs}/{mapk}/{ngaylamviec}/{calamviec}', [LichlamviecController::class, 'update']);
Route::delete('/lichlamviec/{mabs}/{mapk}/{ngaylamviec}/{calamviec}', [LichlamviecController::class, 'destroy']);
Route::get('/lichlamviec/phongkham/{mapk}', [LichlamviecController::class, 'showByMapk']);

Route::get('/thuoc', [thuocController::class, 'index']);

// Tạo thuốc mới
Route::post('/thuoc', [thuocController::class, 'store']);

// Lấy thông tin chi tiết một thuốc
Route::get('/thuoc/{id}', [thuocController::class, 'show']);

// Cập nhật thông tin thuốc
Route::put('/thuoc/{id}', [thuocController::class, 'update']);
// Route để cập nhật nhiều thuốc
Route::put('/thuoc/multiple', [thuocController::class, 'updateMultiple']);
Route::patch('/thuoc/{id}', [thuocController::class, 'update']); // Hỗ trợ cả PATCH

// Xóa thuốc
Route::delete('/thuoc/{id}', [thuocController::class, 'destroy']);

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

Route::get('/canlamsang', [CanlamsangController::class, 'index']);       // Lấy danh sách cận lâm sàng
Route::post('/canlamsang', [CanlamsangController::class, 'store']);         // Thêm mới cận lâm sàng
Route::get('/canlamsang/{id}', [CanlamsangController::class, 'show']);      // Lấy chi tiết cận lâm sàng
Route::put('/canlamsang/{id}', [CanlamsangController::class, 'update']);    // Cập nhật cận lâm sàng
Route::delete('/canlamsang/{id}', [CanlamsangController::class, 'destroy']);

Route::get('/benhly', [BenhlyController::class, 'index']);
Route::post('/benhly', [BenhlyController::class, 'store']);         // Thêm mới bệnh lý
Route::get('/benhly/{id}', [BenhlyController::class, 'show']);      // Lấy chi tiết bệnh lý
Route::put('/benhly/{id}', [BenhlyController::class, 'update']);    // Cập nhật bệnh lý
Route::delete('/benhly/{id}', [BenhlyController::class, 'destroy']); 

Route::get('/hoadon', [HoadonController::class, 'index']);       // Get all invoices
Route::post('/hoadon', [HoadonController::class, 'store']);      // Create a new invoice
Route::get('/hoadon/{id}', [HoadonController::class, 'show']);   // Get details of a specific invoice
Route::put('/hoadon/{id}', [HoadonController::class, 'update']); // Update a specific invoice
Route::delete('/hoadon/{id}', [HoadonController::class, 'destroy']); // Delete a specific invoice

Route::get('/', [CtkhambenhController::class, 'index']);
Route::get('/{makb}', [CtkhambenhController::class, 'show']);
Route::post('/create-and-count', [CtkhambenhController::class, 'createAndCount']);
Route::put('/{makb}', [CtkhambenhController::class, 'update']);
Route::delete('/{makb}', [CtkhambenhController::class, 'destroy']);
Route::get('/mabn/{mabn}', [CtkhambenhController::class, 'getByMabn']);

Route::get('/canls', [CanlamsangController::class, 'index']);          // Lấy danh sách cận lâm sàng
Route::post('/canls', [CanlamsangController::class, 'store']);         // Thêm mới cận lâm sàng
Route::get('/canls/{id}', [CanlamsangController::class, 'show']);      // Lấy chi tiết cận lâm sàng
Route::put('/canls/{id}', [CanlamsangController::class, 'update']);    // Cập nhật cận lâm sàng
Route::delete('/canls/{id}', [CanlamsangController::class, 'destroy']);

Route::prefix('bhyt')->group(function () {
    Route::get('/', [BhytController::class, 'index']);               // Lấy danh sách tất cả BHYT
    Route::get('/{id}', [BhytController::class, 'show']);            // Lấy thông tin chi tiết BHYT
    Route::post('/', [BhytController::class, 'store']);              // Thêm mới BHYT
    Route::put('/{id}', [BhytController::class, 'update']);          // Cập nhật BHYT
    Route::delete('/{id}', [BhytController::class, 'destroy']);      // Xóa BHYT
});

Route::get('/lichlamviec', [LichlamviecController::class, 'index']);
Route::post('/lichlamviec', [LichlamviecController::class, 'store']);
Route::get('/lichlamviec/{mabs}/{mapk}/{ngaylamviec}/{calamviec}', [LichlamviecController::class, 'show']);
Route::put('/lichlamviec/{mabs}/{mapk}/{ngaylamviec}/{calamviec}', [LichlamviecController::class, 'update']);
Route::delete('/lichlamviec/{mabs}/{mapk}/{ngaylamviec}/{calamviec}', [LichlamviecController::class, 'destroy']);
Route::get('/lichlamviec/phongkham/{mapk}', [LichlamviecController::class, 'showByMapk']);
