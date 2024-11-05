<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ctdt;

class CtdtController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'madt' => 'required|exists:donthuoc,madt',
            'mathuoc' => 'required|exists:thuoc,mathuoc',
            'soluong' => 'required|integer',
        ]);

        $ctdt = Ctdt::create($request->all());
        return response()->json($ctdt, 201);
    }

    public function show($id)
    {
        $ctdt = Ctdt::findOrFail($id);
        return response()->json($ctdt);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'soluong' => 'sometimes|required|integer',
        ]);

        $ctdt = Ctdt::findOrFail($id);
        $ctdt->update($request->all());
        return response()->json($ctdt);
    }

    public function destroy($id)
    {
        $ctdt = Ctdt::findOrFail($id);
        $ctdt->delete();
        return response()->json(['message' => 'Record deleted successfully']);
    }
}
