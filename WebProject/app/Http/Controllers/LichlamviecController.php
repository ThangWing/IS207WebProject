<?php

namespace App\Http\Controllers;

use App\Models\Lichlamviec;
use Illuminate\Http\Request;

class LichlamviecController extends Controller
{
    public function index()
    {
        try {
            $lichLamViec = Lichlamviec::with(['bacsi', 'phongkham'])->get();
            return response()->json($lichLamViec); // Đảm bảo luôn trả về JSON
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
}

        public function showByMabs($mabs)
        {
            try {
                $lichLamViec = Lichlamviec::where('mabs', $mabs)->with(['bacsi', 'phongkham'])->get();

                if ($lichLamViec->isEmpty()) {
                    return response()->json(['message' => 'Không tìm thấy lịch làm việc cho phòng khám này!'], 404);
                }

                return response()->json($lichLamViec);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

    // Tạo mới một lịch làm việc
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'mabs' => 'required|string|exists:bacsi,mabs',
                'mapk' => 'required|string|exists:phongkham,mapk',
                'ngaylamviec' => 'required|date',
                'calamviec' => 'required|string|max:20',
            ]);
        
            $lichLamViec = Lichlamviec::create($validated);
        
            return response()->json(['message' => 'Lịch làm việc được tạo thành công!', 'data' => $lichLamViec], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Đã có lỗi xảy ra.', 'message' => $e->getMessage()], 500);
        }
    }

    // Lấy chi tiết một lịch làm việc
    public function show($mabs, $mapk, $ngaylamviec, $calamviec)
    {
        $lichLamViec = Lichlamviec::where(compact('mabs', 'mapk', 'ngaylamviec', 'calamviec'))->first();

        if (!$lichLamViec) {
            return response()->json(['message' => 'Không tìm thấy lịch làm việc!'], 404);
        }

        return response()->json($lichLamViec);
    }

    // Cập nhật một lịch làm việc
    public function update(Request $request, $mabs, $mapk, $ngaylamviec, $calamviec)
    {
        $lichLamViec = Lichlamviec::where(compact('mabs', 'mapk', 'ngaylamviec', 'calamviec'))->first();

        if (!$lichLamViec) {
            return response()->json(['message' => 'Không tìm thấy lịch làm việc!'], 404);
        }

        $validated = $request->validate([
            'calamviec' => 'sometimes|string|max:20',
        ]);

        $lichLamViec->update($validated);

        return response()->json(['message' => 'Cập nhật thành công!', 'data' => $lichLamViec]);
    }

    // Xóa một lịch làm việc
    public function destroy($mabs, $mapk, $ngaylamviec, $calamviec)
    {
        $lichLamViec = Lichlamviec::where(compact('mabs', 'mapk', 'ngaylamviec', 'calamviec'));

        if (!$lichLamViec) {
            return response()->json(['message' => 'Không tìm thấy lịch làm việc!'], 404);
        }

        $lichLamViec->delete();

        return response()->json(['message' => 'Xóa thành công!']);
    }

    public function showByMapk($mapk)
    {
        try {
            $lichLamViec = Lichlamviec::where('mapk', $mapk)->with(['bacsi', 'phongkham'])->get();

            if ($lichLamViec->isEmpty()) {
                return response()->json(['message' => 'Không tìm thấy lịch làm việc cho phòng khám này!'], 404);
            }

            return response()->json($lichLamViec);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
