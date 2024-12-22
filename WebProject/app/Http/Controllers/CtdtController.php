<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ctdt;
use Illuminate\Support\Facades\DB;

class CtdtController extends Controller
{
    // Lấy danh sách tất cả các dòng trong bảng ctdt
    public function index()
    {
        $ctdt = Ctdt::with(['donthuoc', 'thuoc'])->get();
        return response()->json($ctdt);
    }

    // Lấy thông tin chi tiết của một dòng
    public function show($madt, $mathuoc)
    {
        $ctdt = Ctdt::where('madt', $madt)->where('mathuoc', $mathuoc)->first();
        if ($ctdt) {
            return response()->json($ctdt);
        } else {
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    // Tạo mới một dòng
    public function store(Request $request)
    {
        $validated = $request->validate([
            'madt' => 'required|integer|exists:donthuoc,madt',
            'mathuoc' => 'required|integer|exists:thuoc,mathuoc',
            'soluong' => 'required|integer|min:1',
        ]);

        $ctdt = Ctdt::create($validated);
        return response()->json($ctdt, 201);
    }

    // Cập nhật thông tin của một dòng
    public function update(Request $request, $madt, $mathuoc)
    {
        $ctdt = Ctdt::where('madt', $madt)->where('mathuoc', $mathuoc)->first();

        if ($ctdt) {
            $validated = $request->validate([
                'soluong' => 'required|integer|min:1',
            ]);

            $ctdt->update($validated);
            return response()->json($ctdt);
        } else {
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    // Xóa một dòng
    public function destroy($madt, $mathuoc)
    {
        $ctdt = Ctdt::where('madt', $madt)->where('mathuoc', $mathuoc)->first();

        if ($ctdt) {
            $ctdt->delete();
            return response()->json(['message' => 'Deleted successfully']);
        } else {
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}