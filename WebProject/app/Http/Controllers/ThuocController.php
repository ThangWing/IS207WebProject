<?php

namespace App\Http\Controllers;

use App\Models\thuoc;
use Illuminate\Http\Request;

class thuocController extends Controller
{
    // Lấy danh sách tất cả thuốc
    public function index()
    {
        $thuoc = thuoc::all();
        return response()->json($thuoc, 200);
    }

    // Tạo thuốc mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenthuoc' => 'required|string|max:200',
            'soluong'  => 'required|integer|min:0',
            'donvi'    => 'required|string|max:100',
            'dongia'   => 'required|numeric|min:0',
            'ghichu'   => 'nullable|string|max:200',
        ]);

        $thuoc = thuoc::create($validated);
        return response()->json($thuoc, 201);
    }

    // Lấy chi tiết một thuốc
    public function show($id)
    {
        $thuoc = thuoc::find($id);

        if (!$thuoc) {
            return response()->json(['message' => 'Thuốc không tồn tại'], 404);
        }

        return response()->json($thuoc, 200);
    }

    // Cập nhật thông tin thuốc
    public function update(Request $request, $id)
    {
        $thuoc = thuoc::find($id);

        if (!$thuoc) {
            return response()->json(['message' => 'Thuốc không tồn tại'], 404);
        }

        $validated = $request->validate([
            'tenthuoc' => 'required|string|max:200',
            'soluong'  => 'required|integer|min:0',
            'donvi'    => 'required|string|max:100',
            'dongia'   => 'required|numeric|min:0',
            'ghichu'   => 'nullable|string|max:200',
        ]);

        $thuoc->update($validated);
        return response()->json($thuoc, 200);
    }

    // Cập nhật nhiều thuốc cùng lúc
    public function updateMultiple(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validated = $request->validate([
            'thuoc' => 'required|array',
            'thuoc.*.id' => 'required|integer|exists:thuocs,id', // Kiểm tra ID thuốc hợp lệ
            'thuoc.*.tenthuoc' => 'required|string|max:200',
            'thuoc.*.soluong' => 'required|integer|min:0',
            'thuoc.*.donvi' => 'required|string|max:100',
            'thuoc.*.dongia' => 'required|numeric|min:0',
            'thuoc.*.ghichu' => 'nullable|string|max:200',
        ]);

        // Cập nhật từng thuốc trong mảng
        $updatedThuocs = [];
        foreach ($validated['thuoc'] as $thuocData) {
            $thuoc = Thuoc::find($thuocData['id']);
            if ($thuoc) {
                $thuoc->update($thuocData);
                $updatedThuocs[] = $thuoc;
            }
        }

        // Trả về danh sách các thuốc đã cập nhật
        return response()->json($updatedThuocs, 200);
    }

    // Xóa thuốc
    public function destroy($id)
    {
        $thuoc = thuoc::find($id);

        if (!$thuoc) {
            return response()->json(['message' => 'Thuốc không tồn tại'], 404);
        }

        $thuoc->delete();
        return response()->json(['message' => 'Xóa thành công'], 200);
    }
}
