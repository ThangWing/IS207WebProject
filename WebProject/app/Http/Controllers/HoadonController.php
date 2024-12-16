<?php

namespace App\Http\Controllers;

use App\Models\Hoadon;
use Illuminate\Http\Request;

class HoadonController extends Controller
{
    /**
     * Hiển thị các dòng hóa đơn 
     */
    public function index()
    {
        // Truy xuất các hóa đơn với mã bệnh nhân tương ứng
        $invoices = Hoadon::with('patient')->get();
        return response()->json($invoices);
    }

    /**
     * Lưu trữ một hóa đơn mới
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'mabn' => 'required|exists:benhnhan,mabn', // Khóa ngoại cho mã bệnh nhân
            'sotien' => 'required|numeric|min:0',
            'ngaylap' => 'required|date',
            'ghichu' => 'nullable|string|max:200',
        ]);

        // Tạo hóa đơn mới
        $invoice = Hoadon::create([
            'mabn' => $request->mabn,
            'sotien' => $request->sotien,
            'ngaylap' => $request->ngaylap,
            'ghichu' => $request->ghichu,
        ]);

        return response()->json($invoice, 201);
    }

    /**
     * Hiển thị một hóa đơn cụ thể
     */
    public function show($id)
    {
        // Tìm và hiển thị hóa đơn
        $invoice = Hoadon::with('patient')->findOrFail($id);
        return response()->json($invoice);
    }

    /**
     * Cập nhật một hóa đơn cụ thể 
     */
    public function update(Request $request, $id)
    {
        // Kiểm tra request
        $request->validate([
            'sotien' => 'sometimes|required|numeric|min:0',
            'ngaylap' => 'sometimes|required|date',
            'ghichu' => 'nullable|string|max:200',
        ]);

        // Tìm và cập nhật hóa đơn
        $invoice = Hoadon::findOrFail($id);
        $invoice->update($request->all());

        return response()->json($invoice);
    }

    /**
     * Xóa một hóa đơn cụ thể 
     */
    public function destroy($id)
    {
        // Tìm và xóa hóa đơn
        $invoice = Hoadon::findOrFail($id);
        $invoice->delete();

        return response()->json(['message' => 'Invoice deleted successfully']);
    }
}
