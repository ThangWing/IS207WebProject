<?php

namespace App\Http\Controllers;

use App\Models\canlamsang;
use Illuminate\Http\Request;

class CanlamsangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCLS()
    {
        $results = DB::table('phongxetnghiem')
            ->join('canlamsang', 'canlamsang.macls', '=', 'phongxetnghiem.macls')
            ->select('phongxetnghiem.mapxn', 'canlamsang.macls', 'canlamsang.tencls', 'canlamsang.gia')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $results,
        ]);
    }

    public function index()
    {
        $canls = canlamsang::all();
        return response()->json($canls);
    }

    // Thêm mới cận lâm sàng
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tencls' => 'required|string|max:200',
            'gia' => 'required|numeric|min:0',
        ]);

        $canls = canlamsang::create($validated);
        return response()->json($canls, 201);
    }

    // Lấy thông tin chi tiết cận lâm sàng
    public function show($id)
    {
        $canls = canlamsang::find($id);

        if (!$canls) {
            return response()->json(['message' => 'Cận lâm sàng không tồn tại'], 404);
        }

        return response()->json($canls);
    }

    // Cập nhật cận lâm sàng
    public function update(Request $request, $id)
    {
        $canls = canlamsang::find($id);

        if (!$canls) {
            return response()->json(['message' => 'Cận lâm sàng không tồn tại'], 404);
        }

        $validated = $request->validate([
            'tencls' => 'required|string|max:200',
            'gia' => 'required|numeric|min:0',
        ]);

        $canls->update($validated);
        return response()->json($canls);
    }

    // Xóa cận lâm sàng
    public function destroy($id)
    {
        $canls = canlamsang::find($id);

        if (!$canls) {
            return response()->json(['message' => 'Cận lâm sàng không tồn tại'], 404);
        }

        $canls->delete();
        return response()->json(['message' => 'Đã xóa cận lâm sàng']);
    }
}
