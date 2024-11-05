<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ctba;

class CtbaController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'maba' => 'required|exists:hsba,maba',
            'mabl' => 'required|exists:benhly,mabl',
        ]);

        $ctba = Ctba::create($request->all());
        return response()->json($ctba, 201);
    }

    // Xem chi tiết bệnh án
    public function show($id)
    {
        $ctba = Ctba::findOrFail($id);
        return response()->json($ctba);
    }

    // Cập nhật chi tiết bệnh án
    public function update(Request $request, $id)
    {
        $request->validate([
            'mabl' => 'sometimes|required|exists:benhly,mabl',
        ]);

        $ctba = Ctba::findOrFail($id);
        $ctba->update($request->all());
        return response()->json($ctba);
    }

    // Xóa chi tiết bệnh án
    public function destroy($id)
    {
        $ctba = Ctba::findOrFail($id);
        $ctba->delete();
        return response()->json(['message' => 'Record deleted successfully']);
    }
}
