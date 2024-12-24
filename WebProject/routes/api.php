<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\BenhnhanController;
use App\Http\Controllers\HsbaController;
use App\Http\Controllers\CtclsController;
use App\Http\Controllers\BacsiController;
use App\Http\Controllers\CtbaController;
use App\Http\Controllers\CtnhapvienController;
use App\Http\Controllers\BenhlyController;
use App\Http\Controllers\CanlamsangController;
use App\Http\Controllers\thuocController;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\CtkhambenhController;
use App\Http\Controllers\BhytController;
use App\Http\Controllers\LichlamviecController;
use App\Http\Controllers\PhongkhamController;
use App\Http\Controllers\PhongxetnghiemController;
use App\Http\Controllers\PhongbenhController;
use App\Http\Controllers\CtdtController;
use App\Http\Controllers\DonthuocController;


Route::get('/lichlamviec', [LichlamviecController::class, 'index']);
Route::post('/lichlamviec', [LichlamviecController::class, 'store']);
Route::get('/lichlamviec/{mabs}/{mapk}/{ngaylamviec}/{calamviec}', [LichlamviecController::class, 'show']);
Route::put('/lichlamviec/{mabs}/{mapk}/{ngaylamviec}/{calamviec}', [LichlamviecController::class, 'update']);
Route::delete('/lichlamviec/{mabs}/{mapk}/{ngaylamviec}/{calamviec}', [LichlamviecController::class, 'destroy']);
Route::get('/lichlamviec/phongkham/{mapk}', [LichlamviecController::class, 'showByMapk']);
Route::get('/lichlamviec/bacsi/{mabs}', [LichlamviecController::class, 'showByMabs']);

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

Route::get('/login', function () {
    
    $user = User::all();
    return response()->json($user, 200);
});
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    return response()->json(['message' => 'Login successful', 'user' => $user]);
});

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
Route::get('bacsi/phongkham/{mapk}', [BacsiController::class, 'getDoctorsByClinic']);

Route::post('/ctcls', [CtclsController::class, 'store']);
Route::put('/ctcls/{maba}/{mapcn}', [CtclsController::class, 'update']);
Route::delete('/ctcls/{maba}/{mapcn}', [CtclsController::class, 'destroy']);

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

Route::get('/hoadon', [HoadonController::class, 'index']);       // Get all invoices
Route::post('/hoadon', [HoadonController::class, 'store']);      // Create a new invoice
Route::get('/hoadon/{id}', [HoadonController::class, 'show']);   // Get details of a specific invoice
Route::put('/hoadon/{id}', [HoadonController::class, 'updateStatus']); // Update a specific invoice
Route::delete('/hoadon/{id}', [HoadonController::class, 'destroy']); // Delete a specific invoice

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

Route::post('/donthuoc', [DonthuocController::class, 'store']);          // Tạo mới đơn thuốc
Route::get('/donthuoc/{id}', [DonthuocController::class, 'show']);       // Xem chi tiết đơn thuốc
Route::put('/donthuoc/{id}', [DonthuocController::class, 'update']);     // Cập nhật đơn thuốc
Route::delete('/donthuoc/{id}', [DonthuocController::class, 'destroy']); //
Route::get('/donthuoc', [DonthuocController::class, 'index']); 

Route::get('/ctkhambenh', [CtkhambenhController::class, 'index']);

// Lấy chi tiết một ctkhambenh theo ID
Route::get('/ctkhambenh/{id}', [CtkhambenhController::class, 'show']);

// Thêm mới ctkhambenh
Route::post('/ctkhambenh', [CtkhambenhController::class, 'store']);

// Cập nhật ctkhambenh
Route::put('/ctkhambenh/{id}', [CtkhambenhController::class, 'update']);

// Xóa ctkhambenh
Route::delete('/ctkhambenh/{id}', [CtkhambenhController::class, 'delete']);

// Đếm số lượng khám bệnh trong ngày
Route::get('/ctkhambenh/count-today', [CtkhambenhController::class, 'countToday']);

Route::apiResource('phongkham', PhongkhamController::class);

Route::get('/pxn', [PhongxetnghiemController::class, 'index']);

// Lấy thông tin chi tiết một phòng theo ID
Route::get('/pxn/{id}', [PhongxetnghiemController::class, 'show']);

// Thêm mới một phòng 
Route::post('/pxn', [PhongxetnghiemController::class, 'store']);

// Cập nhật thông tin phòng 
Route::put('/pxn/{id}', [PhongxetnghiemController::class, 'update']);

// Xóa một phòng 
Route::delete('/pxn/{id}', [PhongxetnghiemController::class, 'delete']);

Route::get('/phongbenh', [PhongbenhController::class, 'index']);

// Lấy thông tin chi tiết một phòng bệnh
Route::get('/phongbenh/{id}', [PhongbenhController::class, 'show']);

// Tạo mới một phòng bệnh
Route::post('/phongbenh', [PhongbenhController::class, 'store']);

// Cập nhật thông tin phòng bệnh
Route::put('/phongbenh/{id}', [PhongbenhController::class, 'update']);

// Xóa một phòng bệnh
Route::delete('/phongbenh/{id}', [PhongbenhController::class, 'destroy']);

Route::get('/ctdt', [CtdtController::class, 'index']);
Route::get('/ctdt/{madt}/{mathuoc}', [CtdtController::class, 'show']);
Route::post('/ctdt', [CtdtController::class, 'store']);
Route::put('/ctdt/{madt}/{mathuoc}', [CtdtController::class, 'update']);
Route::delete('/ctdt/{madt}/{mathuoc}', [CtdtController::class, 'destroy']);
 
