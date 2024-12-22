<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ctcls;
use Illuminate\Support\Facades\DB;

class CtclsController extends Controller
{

// Thêm mới CTCLS
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'maba' => 'required|integer',
            'macls' => 'required|integer',
            'ketqua' => 'nullable|string|max:300',
        ]);

        $ctcls = Ctcls::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'CTCLS created successfully!',
            'data' => $ctcls,
        ]);
    }

    // Cập nhật CTCLS
    public function update(Request $request, $maba, $macls)
    {
        $validatedData = $request->validate([
            'ketqua' => 'nullable|string|max:300',
        ]);

        $ctcls = Ctcls::where('maba', $maba)
            ->where('macls', $macls)
            ->firstOrFail();

        $ctcls->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'CTCLS updated successfully!',
            'data' => $ctcls,
        ]);
    }

    // Xóa CTCLS
    public function destroy($maba, $mapcn)
    {
        $ctcls = Ctcls::where('maba', $maba)
            ->where('macls', $mapcn)
            ->firstOrFail();

        $ctcls->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'CTCLS deleted successfully!',
        ]);
    }
}
