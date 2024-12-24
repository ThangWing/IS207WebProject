<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use App\Models\HSBA;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HoaDonController extends Controller
{
    public function index()
    {
        $records = Hoadon::with('hsba')->get(); // Lấy danh sách hóa đơn cùng thông tin hồ sơ bệnh án
        return response()->json($records);
    }

    // Thêm hóa đơn mới
    public function store(Request $request)
    {
        $request->validate([
            'maba' => 'required|exists:hsba,maba',
            'ghi_chu' => 'nullable|string',
            'thoi_gian_tao' => 'nullable|date',
        ]);

        $hoaDon = new Hoadon();
        $hoaDon->mahd = 'HD' . time(); // Tạo mã hóa đơn tự động
        $hoaDon->maba = $request->maba;
        $hoaDon->ghi_chu = $request->ghi_chu;
        $hoaDon->trang_thai = 'chua_thanh_toan';
        $hoaDon->thoi_gian_tao = $request->thoi_gian_tao ?? Carbon::now(); // Nếu không có thời gian tạo thì lấy thời gian hiện tại

        $hoaDon->tong_tien = $hoaDon->tinhTongTien(); // Hàm tính tổng tiền (bạn cần định nghĩa trong model)

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

        $hoaDon = Hoadon::findOrFail($id);
        $hoaDon->trang_thai = $request->trang_thai;
        $hoaDon->save();

        return response()->json([
            'message' => 'Cập nhật trạng thái thành công',
            'data' => $hoaDon
        ]);
    }

    // Thống kê theo năm
    public function thongKeTheoNam(Request $request)
    {
        $nam = $request->nam ?? date('Y');

        $thongKe = HoaDon::whereYear('thoi_gian_tao', $nam)
            ->where('trang_thai', 'da_thanh_toan')
            ->select(
                DB::raw('MONTH(thoi_gian_tao) as thang'),
                DB::raw('COUNT(*) as so_hoa_don'),
                DB::raw('SUM(tong_tien) as tong_doanh_thu')
            )
            ->groupBy('thang')
            ->orderBy('thang')
            ->get();

        // Tính tổng cả năm
        $tongNam = [
            'tong_so_hoa_don' => $thongKe->sum('so_hoa_don'),
            'tong_doanh_thu' => $thongKe->sum('tong_doanh_thu')
        ];

        return response()->json([
            'nam' => $nam,
            'thong_ke_theo_thang' => $thongKe,
            'tong_nam' => $tongNam
        ]);
    }

    // Thống kê theo tháng
    public function thongKeTheoThang(Request $request)
    {
        $thang = $request->thang ?? date('m');
        $nam = $request->nam ?? date('Y');

        $thongKe = HoaDon::whereYear('thoi_gian_tao', $nam)
            ->whereMonth('thoi_gian_tao', $thang)
            ->where('trang_thai', 'da_thanh_toan')
            ->select(
                DB::raw('DATE(thoi_gian_tao) as ngay'),
                DB::raw('COUNT(*) as so_hoa_don'),
                DB::raw('SUM(tong_tien) as doanh_thu')
            )
            ->groupBy('ngay')
            ->orderBy('ngay')
            ->get();

        // Tính tổng tháng
        $tongThang = [
            'tong_so_hoa_don' => $thongKe->sum('so_hoa_don'),
            'tong_doanh_thu' => $thongKe->sum('doanh_thu')
        ];

        return response()->json([
            'thang' => $thang,
            'nam' => $nam,
            'thong_ke_theo_ngay' => $thongKe,
            'tong_thang' => $tongThang
        ]);
    }

    // Thống kê theo quý
    public function thongKeTheoQuy(Request $request)
    {
        $nam = $request->nam ?? date('Y');
        $quy = $request->quy ?? ceil(date('m') / 3);

        // Xác định tháng bắt đầu và kết thúc của quý
        $thangBatDau = ($quy - 1) * 3 + 1;
        $thangKetThuc = $quy * 3;

        $thongKe = HoaDon::whereYear('thoi_gian_tao', $nam)
            ->whereMonth('thoi_gian_tao', '>=', $thangBatDau)
            ->whereMonth('thoi_gian_tao', '<=', $thangKetThuc)
            ->where('trang_thai', 'da_thanh_toan')
            ->select(
                DB::raw('MONTH(thoi_gian_tao) as thang'),
                DB::raw('COUNT(*) as so_hoa_don'),
                DB::raw('SUM(tong_tien) as doanh_thu')
            )
            ->groupBy('thang')
            ->orderBy('thang')
            ->get();

        // Tính tổng quý
        $tongQuy = [
            'tong_so_hoa_don' => $thongKe->sum('so_hoa_don'),
            'tong_doanh_thu' => $thongKe->sum('doanh_thu')
        ];

        // Thêm thông tin so sánh với quý trước
        $thongKeQuyTruoc = $this->getThongKeQuyTruoc($nam, $quy);
        $soSanh = [
            'tang_giam_doanh_thu' => $tongQuy['tong_doanh_thu'] - $thongKeQuyTruoc['tong_doanh_thu'],
            'phan_tram_tang_giam' => $thongKeQuyTruoc['tong_doanh_thu'] > 0 
                ? (($tongQuy['tong_doanh_thu'] - $thongKeQuyTruoc['tong_doanh_thu']) / $thongKeQuyTruoc['tong_doanh_thu'] * 100)
                : 0
        ];

        return response()->json([
            'nam' => $nam,
            'quy' => $quy,
            'thong_ke_theo_thang' => $thongKe,
            'tong_quy' => $tongQuy,
            'so_sanh_quy_truoc' => $soSanh
        ]);
    }

    // Phương thức hỗ trợ để lấy thống kê của quý trước
    private function getThongKeQuyTruoc($nam, $quy)
    {
        // Xác định năm và quý trước
        if ($quy == 1) {
            $namTruoc = $nam - 1;
            $quyTruoc = 4;
        } else {
            $namTruoc = $nam;
            $quyTruoc = $quy - 1;
        }

        $thangBatDau = ($quyTruoc - 1) * 3 + 1;
        $thangKetThuc = $quyTruoc * 3;

        $thongKe = HoaDon::whereYear('thoi_gian_tao', $namTruoc)
            ->whereMonth('thoi_gian_tao', '>=', $thangBatDau)
            ->whereMonth('thoi_gian_tao', '<=', $thangKetThuc)
            ->where('trang_thai', 'da_thanh_toan')
            ->select(
                DB::raw('SUM(tong_tien) as tong_doanh_thu')
            )
            ->first();

        return [
            'tong_doanh_thu' => $thongKe->tong_doanh_thu ?? 0
        ];
    }
}
