<?php

namespace App\Http\Controllers;

use App\Models\phongbenh;
use Illuminate\Http\Request;

class PhongbenhController extends Controller
{
    // Hiển thị danh sách phòng bệnh
    public function index()
    {
        $phongbenh = phongbenh::with('khoa')->get(); // Lấy danh sách phòng bệnh cùng thông tin khoa
        return response()->json($phongbenh); // Trả về JSON
    }

    // Hiển thị thông tin chi tiết một phòng bệnh
    public function show($id)
    {
        $phongbenh = phongbenh::with('khoa')->find($id);

        if (!$phongbenh) {
            return response()->json(['message' => 'Phòng bệnh không tồn tại'], 404);
        }

        return response()->json($phongbenh);
    }

    // Tạo mới một phòng bệnh
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tenphong' => 'required|string|max:200',
            'vitri' => 'required|string|max:200',
            'loaidv' => 'required|string|max:100',
            'makhoa' => 'required|exists:khoa,makhoa', // makhoa phải tồn tại trong bảng khoa
        ]);

        $phongbenh = phongbenh::create($validatedData);

        return response()->json(['message' => 'Tạo phòng bệnh thành công', 'data' => $phongbenh], 201);
    }

    // Cập nhật thông tin phòng bệnh
    public function update(Request $request, $id)
    {
        $phongbenh = phongbenh::find($id);

        if (!$phongbenh) {
            return response()->json(['message' => 'Phòng bệnh không tồn tại'], 404);
        }

        $validatedData = $request->validate([
            'tenphong' => 'string|max:200',
            'vitri' => 'string|max:200',
            'loaidv' => 'string|max:100',
            'makhoa' => 'exists:khoa,makhoa',
        ]);

        $phongbenh->update($validatedData);

        return response()->json(['message' => 'Cập nhật phòng bệnh thành công', 'data' => $phongbenh]);
    }

    // Xóa một phòng bệnh
    public function destroy($id)
    {
        $phongbenh = phongbenh::find($id);

        if (!$phongbenh) {
            return response()->json(['message' => 'Phòng bệnh không tồn tại'], 404);
        }

        $phongbenh->delete();

        return response()->json(['message' => 'Xóa phòng bệnh thành công']);
    }
}
