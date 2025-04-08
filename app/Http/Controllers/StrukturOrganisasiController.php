<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage struktur organisasi";
        $data = StrukturOrganisasi::latest()->get();
        // dd($data);

        // Pass the fetched posts to the view
        return view('backend.struktur-organisasi.index', compact('pageTitle', 'data'));
    }

    public function create()
    {
        $pageTitle = "Add new struktur organisasi";
        return view('backend.struktur-organisasi.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' =>'required',
            'image' => 'required|image'
        ]);

        $image = $request->file('image');
        $imageName = time(). '.'. $image->getClientOriginalName();
        $image->move(public_path('media/struktur-organisasi'), $imageName);

        StrukturOrganisasi::create([
            'title' => $request->title,
            'image' => $imageName
        ]);

        Alert::success('Struktur organisasi successfully added!');
        return redirect()->route('struktur-organisasi.index');
    }

    public function edit($id)
    {
        $pageTitle = "Edit struktur organisasi";
        $data = StrukturOrganisasi::find($id);
        return view('backend.struktur-organisasi.edit', compact('pageTitle', 'data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' =>'required',
            'image' => 'required|image'
        ]);

        $data = StrukturOrganisasi::find($id);

        if ($request->hasFile('image')) {
            File::delete(public_path('/media/struktur-organisasi/' . $data->image));
            $image = $request->file('image');
            $imageName = time(). '.'. $image->getClientOriginalName();
            $image->move(public_path('media/struktur-organisasi'), $imageName);
        }

        $data->update([
            'title' => $request->title,
            'image' => $imageName
        ]);

        Alert::success('Struktur organisasi successfully updated!');
        return redirect()->route('struktur-organisasi.index');
    }

    public function destroy($id)
    {
        $data = StrukturOrganisasi::find($id);
        File::delete(public_path('/media/struktur-organisasi/' . $data->image));
        $data->delete();

        Alert::success('Struktur organisasi successfully deleted!');
        return redirect()->route('struktur-organisasi.index');
    }
}
