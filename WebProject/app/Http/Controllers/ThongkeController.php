<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\Hsba;

class ThongKeController extends Controller
{
    public function thongKeBenhNhanTheoBenhLy()
    {
        $data = Hsba::select('benhly as disease', DB::raw('COUNT(*) as value'))
            ->groupBy('benhly')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function thongKeDoanhThuTheoNam()
    {
        $data = HoaDon::selectRaw('YEAR(thoi_gian_tao) as year, SUM(tong_tien) as value')
            ->where('trang_thai', 'da_thanh_toan')
            ->groupByRaw('YEAR(thoi_gian_tao)')
            ->orderBy('year')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function thongKeDoanhThuTheoThang()
    {
        $data = HoaDon::selectRaw('MONTH(thoi_gian_tao) as month, SUM(tong_tien) as value')
            ->where('trang_thai', 'da_thanh_toan')
            ->groupByRaw('MONTH(thoi_gian_tao)')
            ->orderBy('month')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function thongKeDoanhThuTheoQuy()
    {
        $data = HoaDon::selectRaw('QUARTER(thoi_gian_tao) as quarter, SUM(tong_tien) as value')
            ->where('trang_thai', 'da_thanh_toan')
            ->groupByRaw('QUARTER(thoi_gian_tao)')
            ->orderBy('quarter')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
