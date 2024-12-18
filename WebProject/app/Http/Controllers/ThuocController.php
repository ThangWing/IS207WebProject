<?php

namespace App\Http\Controllers;

use App\Models\thuoc;
use Illuminate\Http\Request;

class ThuocController extends Controller
{
     // Lấy danh sách tất cả thuốc
     public function index()
     {
         $thuoc = Thuoc::all();
         return response()->json($thuoc, 200);
     }
 
     // Tạo thuốc mới
     public function store(Request $request)
     {
         $validated = $request->validate([
             'tenthuoc' => 'required|string|max:200',
             'soluong'  => 'required|integer|min:0',
             'donvi'    => 'required|string|max:100',
             'dongia'   => 'required|numeric|min:0',
             'ghichu'   => 'nullable|string|max:200',
         ]);
 
         $thuoc = Thuoc::create($validated);
         return response()->json($thuoc, 201);
     }
 
     // Lấy chi tiết một thuốc
     public function show($id)
     {
         $thuoc = Thuoc::find($id);
 
         if (!$thuoc) {
             return response()->json(['message' => 'Thuốc không tồn tại'], 404);
         }
 
         return response()->json($thuoc, 200);
     }
 
     // Cập nhật thông tin thuốc
     public function update(Request $request, $id)
     {
         $thuoc = Thuoc::find($id);
 
         if (!$thuoc) {
             return response()->json(['message' => 'Thuốc không tồn tại'], 404);
         }
 
         $validated = $request->validate([
             'tenthuoc' => 'required|string|max:200',
             'soluong'  => 'required|integer|min:0',
             'donvi'    => 'required|string|max:100',
             'dongia'   => 'required|numeric|min:0',
             'ghichu'   => 'nullable|string|max:200',
         ]);
 
         $thuoc->update($validated);
         return response()->json($thuoc, 200);
     }
 
     // Xóa thuốc
     public function destroy($id)
     {
         $thuoc = Thuoc::find($id);
 
         if (!$thuoc) {
             return response()->json(['message' => 'Thuốc không tồn tại'], 404);
         }
 
         $thuoc->delete();
         return response()->json(['message' => 'Xóa thành công'], 200);
     }
}
