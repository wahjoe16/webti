<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = "Manage mata kuliah";
        $data = Matkul::orderBy('semester', 'ASC')->get();
        return view('backend.matkul.index', compact('pageTitle', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'semester' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = Matkul::create([
            'nama' => $request->nama,
            'semester' => $request->semester,
            'sks' => $request->sks
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mata kuliah successfully created',
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Matkul::find($id);
        return response()->json([
            'success' => true,
            'message' => "Detail mata kuliah",
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matkul $matkul)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'semester' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $matkul->update([
            'nama' => $request->nama,
            'semester' => $request->semester,
            'sks' => $request->sks
        ]);

        return response()->json([
           'success' => true,
           'message' => 'Mata kuliah successfully updated',
           'data' => $matkul
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Matkul::find($id);
        $data->delete();

        return response()->json([
           'success' => true,
           'message' => 'Mata kuliah successfully deleted!'
        ]);
    }
}
