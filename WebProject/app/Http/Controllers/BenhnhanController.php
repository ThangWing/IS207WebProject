<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BenhnhanController extends Controller
{
    //
    public function index()
    {
        $patients = Patient::all();
        return response()->json($patients);
    }

    // Tạo mới bệnh nhân
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:patients,email',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
        ]);

        $patient = Patient::create($request->all());
        return response()->json($patient, 201);
    }

    // Hiển thị thông tin một bệnh nhân cụ thể
    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return response()->json($patient);
    }

    // Cập nhật thông tin bệnh nhân
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:100',
            'email' => 'sometimes|required|email|unique:patients,email,' . $id,
            'phone' => 'sometimes|required|string|max:15',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
        ]);

        $patient = Patient::findOrFail($id);
        $patient->update($request->all());
        return response()->json($patient);
    }

    // Xóa bệnh nhân
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return response()->json(['message' => 'Patient deleted successfully']);
    }
}
