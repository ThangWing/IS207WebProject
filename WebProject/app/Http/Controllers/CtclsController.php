<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ctcls;

class CtclsController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'maba' => 'required|exists:hsba,maba',
            'macls' => 'required|exists:canls,macls',
        ]);

        $ctcls = Ctcls::create($request->all());
        return response()->json($ctcls, 201);
    }

    public function show($id)
    {
        $ctcls = Ctcls::findOrFail($id);
        return response()->json($ctcls);
    }

    public function update(Request $request, $id)
    {
        $ctcls = Ctcls::findOrFail($id);
        $ctcls->update($request->all());
        return response()->json($ctcls);
    }

    public function destroy($id)
    {
        $ctcls = Ctcls::findOrFail($id);
        $ctcls->delete();
        return response()->json(['message' => 'Record deleted successfully']);
    }
}
