<?php

namespace App\Http\Controllers;

use App\Models\phongkham;
use Illuminate\Http\Request;

class PhongkhamController extends Controller
{
    // Hiển thị danh sách phòng khám
    public function index()
    {
        $phongkham = phongkham::with('khoa')->get(); // Lấy danh sách phòng khám cùng thông tin khoa
        return response()->json($phongkham); // Trả về JSON
    }

    // Hiển thị thông tin chi tiết một phòng khám
    public function show($id)
    {
        $phongkham = phongkham::with('khoa')->find($id);

        if (!$phongkham) {
            return response()->json(['message' => 'Phòng khám không tồn tại'], 404);
        }

        return response()->json($phongkham);
    }

    // Tạo mới một phòng khám
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tenphong' => 'required|string|max:200',
            'vitri' => 'required|string|max:200',
            'makhoa' => 'required|exists:khoa,makhoa', // makhoa phải tồn tại trong bảng khoa
        ]);

        $phongkham = phongkham::create($validatedData);

        return response()->json(['message' => 'Tạo phòng khám thành công', 'data' => $phongkham], 201);
    }

    // Cập nhật thông tin phòng khám
    public function update(Request $request, $id)
    {
        $phongkham = phongkham::find($id);

        if (!$phongkham) {
            return response()->json(['message' => 'Phòng khám không tồn tại'], 404);
        }

        $validatedData = $request->validate([
            'tenphong' => 'string|max:200',
            'vitri' => 'string|max:200',
            'makhoa' => 'exists:khoa,makhoa',
        ]);

        $phongkham->update($validatedData);

        return response()->json(['message' => 'Cập nhật phòng khám thành công', 'data' => $phongkham]);
    }

    // Xóa một phòng khám
    public function destroy($id)
    {
        $phongkham = phongkham::find($id);

        if (!$phongkham) {
            return response()->json(['message' => 'Phòng khám không tồn tại'], 404);
        }

        $phongkham->delete();

        return response()->json(['message' => 'Xóa phòng khám thành công']);
    }
}
