<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Benhnhan;

class BenhnhanController extends Controller
{
    public function index()
    {
        $benhnhans = Benhnhan::with('bhyt')->get();;
        return response()->json($benhnhans, 200);
    }

    // Tạo bệnh nhân mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenbn' => 'required|string|max:100',
            'ngsinh' => 'required|date',
            'gioitinh' => 'required|string|max:10',
            'cccd' => 'required|string|unique:benhnhan,cccd',
            'sdt' => 'required|string|unique:benhnhan,sdt',
            'diachi' => 'required|string|max:100',
            'ghichu' => 'nullable|string|max:200',
        ]);

        $benhnhan = Benhnhan::create($validated);

        return response()->json([
            'message' => 'Bệnh nhân được tạo thành công',
            'data' => $benhnhan,
        ], 201);
    }

    // Lấy thông tin chi tiết một bệnh nhân
    public function show($id)
    {
        $benhnhan = Benhnhan::with('bhyt')->find($id);

        if (!$benhnhan) {
            return response()->json(['message' => 'Bệnh nhân không tồn tại'], 404);
        }

        return response()->json($benhnhan, 200);
    }


    // Cập nhật thông tin bệnh nhân
    public function update(Request $request, $id)
    {
        $benhnhan = Benhnhan::find($id);

        if (!$benhnhan) {
            return response()->json(['message' => 'Bệnh nhân không tồn tại'], 404);
        }

        $validated = $request->validate([
            'tenbn' => 'sometimes|required|string|max:100',
            'ngsinh' => 'sometimes|required|date',
            'gioitinh' => 'sometimes|required|string|max:10',
            'cccd' => 'sometimes|required|string|unique:benhnhan,cccd,' . $id . ',mabn',
            'sdt' => 'sometimes|required|string|unique:benhnhan,sdt,' . $id . ',mabn',
            'diachi' => 'sometimes|required|string|max:100',
            'ghichu' => 'nullable|string|max:200',
        ]);

        $benhnhan->update($validated);

        return response()->json([
            'message' => 'Cập nhật thông tin thành công',
            'data' => $benhnhan,
        ], 200);
    }

    // Xóa bệnh nhân
    public function destroy($id)
    {
        $benhnhan = Benhnhan::find($id);

        if (!$benhnhan) {
            return response()->json(['message' => 'Bệnh nhân không tồn tại'], 404);
        }

        // Xóa Bhyt liên quan
        $benhnhan->bhyt()->delete();

        // Xóa Bệnh nhân
        $benhnhan->delete();

        return response()->json(['message' => 'Bệnh nhân và bảo hiểm y tế liên quan đã được xóa thành công'], 200);
    }
}
