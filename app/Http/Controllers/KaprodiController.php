<?php

namespace App\Http\Controllers;

use App\Models\Kaprodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class KaprodiController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage kaprodi";
        $data = Kaprodi::latest()->get();
        // dd($data);

        // Pass the fetched posts to the view
        return view('backend.kaprodi.index', compact('pageTitle', 'data'));
    }

    public function create()
    {
        $pageTitle = "Add new kaprodi";
        return view('backend.kaprodi.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required',
            'periode' =>'required',
            'photo' => 'required|image'
        ]);

        $photo = $request->file('photo');
        $photoName = time(). '.'. $photo->getClientOriginalName();
        $photo->move(public_path('media/kaprodi'), $photoName);

        Kaprodi::create([
            'name' => $request->name,
            'periode' => $request->periode,
            'photo' => $photoName
        ]);

        Alert::success('Kaprodi successfully added!');
        return redirect()->route('kaprodi.index');
    }

    public function edit($id)
    {
        $pageTitle = "Edit kaprodi";
        $data = Kaprodi::find($id);
        return view('backend.kaprodi.edit', compact('pageTitle', 'data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'required',
            'periode' =>'required',
            'photo' => 'image'
        ]);

        $data = Kaprodi::find($id);

        if ($request->hasFile('photo')) {
            File::delete(public_path('/media/kaprodi/' . $data->photo));
            $photo = $request->file('photo');
            $photoName = time(). '.'. $photo->getClientOriginalName();
            $photo->move(public_path('media/kaprodi'), $photoName);
        }

        $data->update([
            'name' => $request->name,
            'periode' => $request->periode,
            'photo' => $photoName?? $request->current_photo
        ]);

        Alert::success('Kaprodi successfully updated!');
        return redirect()->route('kaprodi.index');
    }

    public function destroy($id)
    {
        $data = Kaprodi::find($id);
        File::delete(public_path('/media/kaprodi/' . $data->photo));
        $data->delete();

        Alert::success('Kaprodi successfully deleted!');
        return redirect()->route('kaprodi.index');
    }
}
