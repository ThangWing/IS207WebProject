<?php

namespace App\Http\Controllers;

use App\Models\Bhyt;
use Illuminate\Http\Request;

class BhytController extends Controller
{
    public function index()
    {
        return response()->json(Bhyt::with('benhnhan')->get(), 200);
    }

    // Lấy thông tin chi tiết một BHYT
    public function show($id)
    {
        $bhyt = Bhyt::with('benhnhan')->find($id);

        if (!$bhyt) {
            return response()->json(['message' => 'Không tìm thấy thông tin BHYT'], 404);
        }

        return response()->json($bhyt, 200);
    }

    // Thêm mới BHYT
    public function store(Request $request)
    {
        $request->validate([
            'mabn' => 'required|exists:benhnhan,mabn',
            'ma_the' => 'required|string|max:20|unique:bhyt,ma_the',
            'doituong' => 'required|string|max:100',
            'ngay_hieu_luc' => 'required|date',
            'ngay_het_han' => 'required|date|after_or_equal:ngay_hieu_luc',
            'noi_dang_ky' => 'nullable|string|max:100',
        ]);

        $bhyt = Bhyt::create($request->all());

        return response()->json($bhyt, 201);
    }

    // Cập nhật thông tin BHYT
    public function update(Request $request, $id)
    {
        $bhyt = Bhyt::find($id);

        if (!$bhyt) {
            return response()->json(['message' => 'Không tìm thấy thông tin BHYT'], 404);
        }

        $request->validate([
            'mabn' => 'required|exists:benhnhan,mabn',
            'ma_the' => "required|string|max:20|unique:bhyt,ma_the,$id,bhytid",
            'doituong' => 'required|string|max:100',
            'ngay_hieu_luc' => 'required|date',
            'ngay_het_han' => 'required|date|after_or_equal:ngay_hieu_luc',
            'noi_dang_ky' => 'nullable|string|max:100',
        ]);

        $bhyt->update($request->all());

        return response()->json($bhyt, 200);
    }

    // Xóa BHYT
    public function destroy($id)
    {
        $bhyt = Bhyt::find($id);

        if (!$bhyt) {
            return response()->json(['message' => 'Không tìm thấy thông tin BHYT'], 404);
        }

        $bhyt->delete();

        return response()->json(['message' => 'Xóa thông tin BHYT thành công'], 200);
    }
}
