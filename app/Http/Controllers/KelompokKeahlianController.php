<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelompokKeahlian;
use Illuminate\Support\Facades\Validator;

class KelompokKeahlianController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage Kelompok Keahlian";
        $data = KelompokKeahlian::orderBy('nama_kelompok', 'ASC')->get();
        return view('backend.kelompok-keahlian.index', compact('pageTitle', 'data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelompok' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = KelompokKeahlian::create([
            'nama_kelompok' => $request->nama_kelompok,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kelompok Keahlian successfully created!',
            'data' => $data
        ]);
    }

    public function show(string $id)
    {
        $data = KelompokKeahlian::find($id);
        return response()->json([
            'success' => true,
            'message' => "Detail kelompok keahlian",
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelompok' =>'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = KelompokKeahlian::find($id);

        $data->update([
            'nama_kelompok' => $request->nama_kelompok,
            'description' => $request->description,
        ]);

        return response()->json([
           'success' => true,
           'message' => 'Kelompok Keahlian successfully updated',
           'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $data = KelompokKeahlian::find($id);
        $data->delete();

        return response()->json([
           'success' => true,
           'message' => 'Kelompok Keahlian successfully deleted!'
        ]);
    }
}
