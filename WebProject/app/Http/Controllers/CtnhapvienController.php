<?php

namespace App\Http\Controllers;

use App\Models\Ctnhapvien;
use Illuminate\Http\Request;

class CtnhapvienController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'maba' => 'required|exists:hsba,maba',
            'maphg' => 'required|exists:phong,maphg',
            'ngnv' => 'required|date',
            'ngxv' => 'nullable|date',
            'loaidv' => 'required|string|max:100',
        ]);

        $ctnhapvien = Ctnhapvien::create($request->all());
        return response()->json($ctnhapvien, 201);
    }

    public function show($id)
    {
        $ctnhapvien = Ctnhapvien::findOrFail($id);
        return response()->json($ctnhapvien);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ngnv' => 'sometimes|required|date',
            'ngxv' => 'nullable|date',
            'loaidv' => 'sometimes|required|string|max:100',
        ]);

        $ctnhapvien = Ctnhapvien::findOrFail($id);
        $ctnhapvien->update($request->all());
        return response()->json($ctnhapvien);
    }

    public function destroy($id)
    {
        $ctnhapvien = Ctnhapvien::findOrFail($id);
        $ctnhapvien->delete();
        return response()->json(['message' => 'Record deleted successfully']);
    }
}
