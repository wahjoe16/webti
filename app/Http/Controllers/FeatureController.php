<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class FeatureController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage features";
        $data = Feature::latest()->get();
        // dd($data);

        // Pass the fetched posts to the view
        return view('backend.feature.index', compact('pageTitle', 'data'));
    }

    public function create()
    {
        $pageTitle = "Add new feature";
        return view('backend.feature.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            'description' =>'required|string',
            'image' => 'image'
        ]);

        $image = $request->file('image');
        $imageName = time(). '.'. $image->getClientOriginalName();
        $image->move(public_path('media/feature'), $imageName);

        Feature::create([
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
            'image' => $imageName
        ]);

        Alert::success('Feature successfully added!');
        return redirect()->route('features.index');
    }

    public function edit($id)
    {
        $pageTitle = "Edit feature";
        $feature = Feature::find($id);
        return view('backend.feature.edit', compact('pageTitle', 'feature'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            'description' =>'required|string',
            'image' => 'image'
        ]);

        $feature = Feature::find($id);

        if ($request->hasFile('image')) {
            File::delete(public_path('/media/feature/' . $feature->image));
            $image = $request->file('image');
            $imageName = time(). '.'. $image->getClientOriginalName();
            $image->move(public_path('media/feature'), $imageName);
        }

        $feature->update([
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
            'image' => $imageName?? $request->current_image
        ]);

        Alert::success('Sambutan feature updated!');
        return redirect()->route('features.index');
    }

    public function destroy($id)
    {
        $feature = Feature::find($id);
        File::delete(public_path('/media/feature/' . $feature->image));
        $feature->delete();

        Alert::success('Sambutan kaprodi successfully deleted!');
        return redirect()->route('features.index');
    }
}
