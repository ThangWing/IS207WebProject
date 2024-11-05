<?php

namespace App\Http\Controllers;

use App\Models\hsba;
use App\Http\Requests\StorehsbaRequest;
use App\Http\Requests\UpdatehsbaRequest;

class HsbaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Hiển thị danh sách hồ sơ bệnh án
    public function index()
    {
        $records = MedicalRecord::with('patient')->get();
        return response()->json($records);
    }

    // Tạo mới hồ sơ bệnh án
    public function store(Request $request)
    {
        $request->validate([
            'mabn' => 'required|exists:patients,mabn',
            'mabl' => 'required|integer',
            'ngnv' => 'required|date',
            'ngxv' => 'nullable|date',
            'kqdt' => 'required|string|max:100',
            'nhapvien' => 'required|boolean',
            'ghichu' => 'nullable|string|max:200',
        ]);

        $record = MedicalRecord::create($request->all());
        return response()->json($record, 201);
    }

    // Hiển thị thông tin một hồ sơ bệnh án cụ thể
    public function show($id)
    {
        $record = MedicalRecord::with('patient')->findOrFail($id);
        return response()->json($record);
    }

    // Cập nhật thông tin hồ sơ bệnh án
    public function update(Request $request, $id)
    {
        $request->validate([
            'mabl' => 'sometimes|required|integer',
            'ngnv' => 'sometimes|required|date',
            'ngxv' => 'nullable|date',
            'kqdt' => 'sometimes|required|string|max:100',
            'nhapvien' => 'sometimes|required|boolean',
            'ghichu' => 'nullable|string|max:200',
        ]);

        $record = MedicalRecord::findOrFail($id);
        $record->update($request->all());
        return response()->json($record);
    }

    // Xóa hồ sơ bệnh án
    public function destroy($id)
    {
        $record = MedicalRecord::findOrFail($id);
        $record->delete();
        return response()->json(['message' => 'Medical record deleted successfully']);
    }
}
