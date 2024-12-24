<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Hsba;
use App\Models\Benhnhan;
use App\Models\thuoc;
use App\Http\Requests\StorehsbaRequest;
use App\Http\Requests\UpdatehsbaRequest;
use Illuminate\Http\Request;


class HsbaController extends Controller
{
    public function index()
{
    try {
        // Lấy tất cả hồ sơ bệnh án và các quan hệ liên quan
        $records = Hsba::with('benhnhan', 'ctba', 'donthuoc', 'ctcls', 'nhapvien', 'ctdts','canls','benhly','hoadon')->get();

        // Duyệt qua từng hồ sơ bệnh án
        $records->each(function ($hsba) {
            // Tạo mảng để lưu tên thuốc từ `ctdt`
            $thuocs = [];

            // Duyệt qua các bản ghi trong `ctdts`
            foreach ($hsba->ctdts as $ctdt) {
                $thuoc = thuoc::find($ctdt->mathuoc); // Truy xuất tên thuốc dựa vào mathuoc
                if ($thuoc) {
                    $thuocs[] = [
                        'mathuoc' => $thuoc->mathuoc,
                        'tenthuoc' => $thuoc->tenthuoc,
                        'soluong' => $ctdt->soluong,
                        'donvi' => $thuoc->donvi,
                        'dongia' => $thuoc->dongia,
                        'ghichu' => $thuoc->ghichu,
                    ];
                }
            }

            // Gắn danh sách thuốc vào thuộc tính mới
            $hsba->thuocs = $thuocs;
        });

        // Trả về JSON dữ liệu
        return response()->json($records);
    } catch (Exception $e) {
        // Xử lý ngoại lệ và trả về lỗi
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
    // Tạo mới hồ sơ bệnh án cho một bệnh nhân xác định
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mabn' => 'required|exists:benhnhan,mabn',
            'nhapvien' => 'required|boolean',
            'chieucao' => 'nullable|string|max:200',
            'cannang' => 'nullable|string|max:200',
            'huyetap' => 'nullable|string|max:200',
            'mach' => 'nullable|string|max:200',
            'trieuchung' => 'nullable|string|max:200',
            'ghichu' => 'nullable|string|max:200',
        ]);

        $hsba = Hsba::create($validated);

        return response()->json([
            'message' => 'Hồ sơ bệnh án được tạo thành công',
            'data' => $hsba,
        ], 201);
    }

    // Lấy chi tiết một hồ sơ bệnh án
    public function show($id)
    {
        $hsba = Hsba::with('benhnhan','ctba','donthuoc','ctcls','nhapvien','ctdts','canls')->find($id);

            // Tạo mảng để lưu tên thuốc từ `ctdt`
            $thuocs = [];

            // Duyệt qua các bản ghi trong `ctdts`
            foreach ($hsba->ctdts as $ctdt) {
                $thuoc = thuoc::find($ctdt->mathuoc); // Truy xuất tên thuốc dựa vào mathuoc
                if ($thuoc) {
                    $thuocs[] = [
                        'mathuoc' => $thuoc->mathuoc,
                        'tenthuoc' => $thuoc->tenthuoc,
                        'soluong' => $ctdt->soluong,
                    ];
                }
            }

        if (!$hsba) {
            return response()->json(['message' => 'Hồ sơ bệnh án không tồn tại'], 404);
        }

        return response()->json($hsba, 200);
    }

    // Cập nhật thông tin hồ sơ bệnh án
    public function update(Request $request, $mabn, $maba)
    {
        $hsba = Hsba::find($maba);

        if (!$hsba) {
            return response()->json(['message' => 'Hồ sơ bệnh án không tồn tại'], 404);
        }

        $validated = $request->validate([
            'mabn' => 'sometimes|required|exists:benhnhan,mabn',
            'nhapvien' => 'sometimes|required|integer',
            'chieucao' => 'nullable|string|max:200',
            'cannang' => 'nullable|string|max:200',
            'huyetap' => 'nullable|string|max:200',
            'mach' => 'nullable|string|max:200',
            'trieuchung' => 'nullable|string|max:200',
            'ghichu' => 'nullable|string|max:200',
        ]);

        $hsba->update($validated);
        return response()->json([
            'message' => 'Cập nhật thông tin thành công',
            'data' => $hsba,
        ], 200);
    }

    // Xóa hồ sơ bệnh án
    public function destroy($id)
    {
        $hsba = Hsba::find($id);

        if (!$hsba) {
            return response()->json(['message' => 'Hồ sơ bệnh án không tồn tại'], 404);
        }

        $hsba->delete();

        return response()->json(['message' => 'Hồ sơ bệnh án đã được xóa thành công'], 200);
    }
}
