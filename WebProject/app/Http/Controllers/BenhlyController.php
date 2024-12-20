<?php

namespace App\Http\Controllers;

use App\Models\benhly;
use Illuminate\Http\Request;

class BenhlyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $benhly = benhly::all();
        return response()->json($benhly);
    }

    // Thêm mới bệnh lý
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenbl' => 'required|string|max:200',
        ]);

        $benhly = benhly::create($validated);
        return response()->json($benhly, 201);
    }

    // Lấy thông tin chi tiết bệnh lý
    public function show($id)
    {
        $benhly = benhly::find($id);

        if (!$benhly) {
            return response()->json(['message' => 'Bệnh lý không tồn tại'], 404);
        }

        return response()->json($benhly);
    }

    // Cập nhật bệnh lý
    public function update(Request $request, $id)
    {
        $benhly = benhly::find($id);

        if (!$benhly) {
            return response()->json(['message' => 'Bệnh lý không tồn tại'], 404);
        }

        $validated = $request->validate([
            'tenbl' => 'required|string|max:200',
        ]);

        $benhly->update($validated);
        return response()->json($benhly);
    }

    // Xóa bệnh lý
    public function destroy($id)
    {
        $benhly = benhly::find($id);

        if (!$benhly) {
            return response()->json(['message' => 'Bệnh lý không tồn tại'], 404);
        }

        $benhly->delete();
        return response()->json(['message' => 'Đã xóa bệnh lý']);
    }
}
