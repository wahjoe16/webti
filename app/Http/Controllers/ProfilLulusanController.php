<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilLulusan;
use Illuminate\Support\Facades\Validator;

class ProfilLulusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = "Manage profil lulusan";
        $data = ProfilLulusan::orderBy('title', 'ASC')->get();
        return view('backend.profil-lulusan.index', compact('pageTitle', 'data'));
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
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = ProfilLulusan::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profil lulusan successfully created',
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = ProfilLulusan::find($id);
        return response()->json([
            'success' => true,
            'message' => "Detail profil lulusan",
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
    public function update(Request $request, ProfilLulusan $profilLulusan)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $profilLulusan->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return response()->json([
           'success' => true,
           'message' => 'Profil lulusan successfully updated',
           'data' => $profilLulusan
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ProfilLulusan::find($id);
        $data->delete();

        return response()->json([
           'success' => true,
           'message' => 'Profil lulusan successfully deleted!'
        ]);
    }
}
