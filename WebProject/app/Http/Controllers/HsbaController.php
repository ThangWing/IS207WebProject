<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Hsba;
use App\Models\Benhnhan;
use App\Http\Requests\StorehsbaRequest;
use App\Http\Requests\UpdatehsbaRequest;

class HsbaController extends Controller
{
    public function index()
    {
        try {
            $records = Hsba::with('benhnhan')->get();
            return response()->json($records);
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    // Tạo mới hồ sơ bệnh án cho một bệnh nhân xác định
    public function store(StorehsbaRequest $request)
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
        $hsba = Hsba::with('benhnhan')->find($id);

        if (!$hsba) {
            return response()->json(['message' => 'Hồ sơ bệnh án không tồn tại'], 404);
        }

        return response()->json($hsba, 200);
    }

    // Cập nhật thông tin hồ sơ bệnh án
    public function update(UpdatehsbaRequest $request, $mabn, $maba)
    {
        $hsba = Hsba::find($id);

        if (!$hsba) {
            return response()->json(['message' => 'Hồ sơ bệnh án không tồn tại'], 404);
        }

        $validated = $request->validate([
            'mabn' => 'sometimes|required|exists:benhnhan,mabn',
            'nhapvien' => 'sometimes|required|boolean',
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
