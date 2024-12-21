<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use App\Models\HSBA;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HoaDonController extends Controller
{
    // Thêm hóa đơn mới
    public function store(Request $request)
    {
        $request->validate([
            'hsba_id' => 'required|exists:hsba,id',
            'ghi_chu' => 'nullable|string',
            'thoi_gian_tao' => 'nullable|date',
        ]);

        $hoaDon = new HoaDon();
        $hoaDon->ma_hoadon = 'HD' . time(); // Tạo mã hóa đơn tự động
        $hoaDon->hsba_id = $request->hsba_id;
        $hoaDon->ghi_chu = $request->ghi_chu;
        $hoaDon->trang_thai = 'chua_thanh_toan';
        $hoaDon->thoi_gian_tao = $request->thoi_gian_tao ?? Carbon::now(); // Nếu không có thời gian tạo thì lấy thời gian hiện tại

        // Tính tổng tiền
        $hoaDon->tong_tien = $hoaDon->tinhTongTien();

        $hoaDon->save();

        return response()->json([
            'message' => 'Tạo hóa đơn thành công',
            'data' => $hoaDon
        ], 201);
    }

    // Xóa hóa đơn
    public function destroy($id)
    {
        $hoaDon = HoaDon::findOrFail($id);
        $hoaDon->delete();

        return response()->json([
            'message' => 'Xóa hóa đơn thành công'
        ]);
    }

    // Tìm kiếm hóa đơn theo số điện thoại
    public function searchByPhone(Request $request)
    {
        $phone = $request->phone;

        $hoaDons = HoaDon::whereHas('hsba.benhnhan', function ($query) use ($phone) {
            $query->where('so_dien_thoai', 'like', "%{$phone}%");
        })
            ->with(['hsba.benhnhan'])
            ->get();

        return response()->json([
            'data' => $hoaDons
        ]);
    }

    // Cập nhật trạng thái thanh toán
    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'trang_thai' => 'required|in:da_thanh_toan,chua_thanh_toan',
        ]);

        $hoaDon = HoaDon::findOrFail($id);
        $hoaDon->trang_thai = $request->trang_thai;
        $hoaDon->save();

        return response()->json([
            'message' => 'Cập nhật trạng thái thành công',
            'data' => $hoaDon
        ]);
    }
}
