<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nhanvien;

class NhanvienController extends Controller
{
    // Lấy danh sách nhân viên
    public function index()
    {
        $employees = Nhanvien::with('phongban', 'congviec')->get();
        return response()->json($employees);
    }

    // Tìm kiếm nhân viên
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $employees = Nhanvien::where('tennv', 'like', "%{$keyword}%")
            ->orWhere('email', 'like', "%{$keyword}%")
            ->orWhere('sdt', 'like', "%{$keyword}%")
            ->with('phongban', 'congviec')
            ->get();

        return response()->json($employees);
    }

    // Tạo mới nhân viên
    public function store(Request $request)
    {
        $request->validate([
            'tennv' => 'required|string|max:100',
            'ngsinh' => 'required|date',
            'gioitinh' => 'required|string|max:10',
            'diachi' => 'required|string|max:100',
            'sdt' => 'required|integer',
            'email' => 'required|string|email|max:100|unique:nhanvien',
            'chucvu' => 'required|string|max:50',
            'maphongban' => 'required|integer'
        ]);

        $employee = Nhanvien::create($request->all());
        return response()->json($employee, 201);
    }

    // Hiển thị thông tin một nhân viên cụ thể
    public function show($id)
    {
        $employee = Nhanvien::with('phongban', 'congviec')->find($id);
        if (!$employee) {
            return response()->json(['message' => 'Nhân viên không tồn tại'], 404);
        }
        return response()->json($employee);
    }

    // Cập nhật thông tin nhân viên
    public function update(Request $request, $id)
    {
        $request->validate([
            'tennv' => 'sometimes|required|string|max:100',
            'ngsinh' => 'sometimes|required|date',
            'gioitinh' => 'sometimes|required|string|max:10',
            'diachi' => 'sometimes|required|string|max:100',
            'sdt' => 'sometimes|required|integer',
            'email' => 'sometimes|required|string|email|max:100|unique:nhanvien,email,' . $id,
            'chucvu' => 'sometimes|required|string|max:50',
            'maphongban' => 'sometimes|required|integer'
        ]);

        $employee = Nhanvien::findOrFail($id);
        $employee->update($request->all());
        return response()->json($employee);
    }

    // Xóa nhân viên
    public function destroy($id)
    {
        $employee = Nhanvien::findOrFail($id);
        $employee->delete();
        return response()->json(['message' => 'Employee deleted successfully']);
    }
}
