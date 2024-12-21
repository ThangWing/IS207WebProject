<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\phongxetnghiem;

class PhongxetnghiemController extends Controller
{
    // Lấy danh sách tất cả phòng xét nghiệm
    public function index()
    {
        try {
            $records = phongxetnghiem::with('canls')->get();
            return response()->json($records, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Lấy thông tin chi tiết phòng xét nghiệm theo ID
    public function show($id)
    {
        try {
            $record = phongxetnghiem::with('canls')->findOrFail($id);
            return response()->json($record, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Không tìm thấy bản ghi'], 404);
        }
    }

    // Thêm mới phòng xét nghiệm
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'macls' => 'required|exists:canls,macls',
                'vitri' => 'required|string|max:200',
            ]);

            $record = phongxetnghiem::create($validated);

            return response()->json([
                'message' => 'Thêm mới phòng xét nghiệm thành công',
                'data' => $record
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Cập nhật thông tin phòng xét nghiệm
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'macls' => 'required|exists:canls,macls',
                'vitri' => 'required|string|max:200',
            ]);

            $record = phongxetnghiem::findOrFail($id);

            $record->update($validated);

            return response()->json([
                'message' => 'Cập nhật phòng xét nghiệm thành công',
                'data' => $record
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Xóa phòng xét nghiệm
    public function destroy($id)
    {
        try {
            $record = phongxetnghiem::findOrFail($id);
            $record->delete();

            return response()->json([
                'message' => 'Xóa phòng xét nghiệm thành công'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Không tìm thấy bản ghi'], 404);
        }
    }
}
