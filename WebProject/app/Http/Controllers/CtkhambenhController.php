<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ctkhambenh;
use Carbon\Carbon;

class CtkhambenhController extends Controller
{
    // Lấy danh sách tất cả ctkhambenh
    public function index()
    {
        try {
            $records = Ctkhambenh::with(['benhnhan', 'phongkham'])->get();
            return response()->json($records, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Lấy thông tin ctkhambenh theo ID
    public function show($id)
    {
        try {
            $record = Ctkhambenh::with(['benhnhan', 'phongkham'])->findOrFail($id);
            return response()->json($record, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    // Thêm mới ctkhambenh
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'mabn' => 'required|exists:benhnhan,mabn',
                'mapk' => 'required|exists:phongkham,mapk',
            ]);

            $ctkhambenh = Ctkhambenh::create([
                'mabn' => $validated['mabn'],
                'mapk' => $validated['mapk'],
                'created_at' => now(),
            ]);

            return response()->json([
                'message' => 'Thêm thành công',
                'data' => $ctkhambenh
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Cập nhật thông tin ctkhambenh
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'mabn' => 'required|exists:benhnhan,mabn',
                'mapk' => 'required|exists:phongkham,mapk',
            ]);

            $ctkhambenh = Ctkhambenh::findOrFail($id);

            $ctkhambenh->update([
                'mabn' => $validated['mabn'],
                'mapk' => $validated['mapk'],
            ]);

            return response()->json([
                'message' => 'Cập nhật thành công',
                'data' => $ctkhambenh
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Xóa ctkhambenh
    public function delete($id)
    {
        try {
            $ctkhambenh = Ctkhambenh::findOrFail($id);
            $ctkhambenh->delete();

            return response()->json([
                'message' => 'Xóa thành công'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Lấy số lượng khám bệnh trong ngày
    public function countToday()
    {
        try {
            $today = Carbon::today();
            $count = Ctkhambenh::whereDate('created_at', $today)->count();

            return response()->json([
                'message' => 'Số lượng khám bệnh hôm nay',
                'count' => $count
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
