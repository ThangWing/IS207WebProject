<?php

namespace App\Http\Controllers;

use App\Models\Lichlamviec;
use App\Http\Requests\StoreLichlamviecRequest;
use App\Http\Requests\UpdateLichlamviecRequest;

class LichlamviecController extends Controller
{
    public function index()
    {
        $lichLamViec = LichLamViec::with(['bacSi', 'phongKham'])->get();
        return response()->json($lichLamViec);
    }

    // Tạo mới một lịch làm việc
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mabs' => 'required|string|exists:bac_si,mabs',
            'mapk' => 'required|string|exists:phong_kham,mapk',
            'ngaylamviec' => 'required|date',
            'calamviec' => 'required|string|max:20',
        ]);

        $lichLamViec = LichLamViec::create($validated);

        return response()->json(['message' => 'Lịch làm việc được tạo thành công!', 'data' => $lichLamViec], 201);
    }

    // Lấy chi tiết một lịch làm việc
    public function show($mabs, $mapk, $ngaylamviec, $calamviec)
    {
        $lichLamViec = LichLamViec::where(compact('mabs', 'mapk', 'ngaylamviec', 'calamviec'))->first();

        if (!$lichLamViec) {
            return response()->json(['message' => 'Không tìm thấy lịch làm việc!'], 404);
        }

        return response()->json($lichLamViec);
    }

    // Cập nhật một lịch làm việc
    public function update(Request $request, $mabs, $mapk, $ngaylamviec, $calamviec)
    {
        $lichLamViec = LichLamViec::where(compact('mabs', 'mapk', 'ngaylamviec', 'calamviec'))->first();

        if (!$lichLamViec) {
            return response()->json(['message' => 'Không tìm thấy lịch làm việc!'], 404);
        }

        $validated = $request->validate([
            'calamviec' => 'sometimes|string|max:20',
        ]);

        $lichLamViec->update($validated);

        return response()->json(['message' => 'Cập nhật thành công!', 'data' => $lichLamViec]);
    }

    // Xóa một lịch làm việc
    public function destroy($mabs, $mapk, $ngaylamviec, $calamviec)
    {
        $lichLamViec = LichLamViec::where(compact('mabs', 'mapk', 'ngaylamviec', 'calamviec'))->first();

        if (!$lichLamViec) {
            return response()->json(['message' => 'Không tìm thấy lịch làm việc!'], 404);
        }

        $lichLamViec->delete();

        return response()->json(['message' => 'Xóa thành công!']);
    }
}
