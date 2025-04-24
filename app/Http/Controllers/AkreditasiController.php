<?php

namespace App\Http\Controllers;

use App\Models\Akreditasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class AkreditasiController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage File Akreditasi";
        $data = Akreditasi::latest()->get();
        // dd($data);

        // Pass the fetched posts to the view
        return view('backend.akreditasi.index', compact('pageTitle', 'data'));
    }

    public function create()
    {
        $pageTitle = "Add new file akreditasi";
        return view('backend.akreditasi.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf'
        ]);

        $file = $request->file('file');
        $fileName = time(). '.'. $file->getClientOriginalName();
        $file->move(public_path('media/akreditasi'), $fileName);

        Akreditasi::create([
            'content' => $request->content,
            'file' => $fileName
        ]);

        Alert::success('File Akreditasi successfully added!');
        return redirect()->route('akreditasi.index');
    }

    public function edit($id)
    {
        $pageTitle = "Edit file akreditasi";
        $data = Akreditasi::find($id);
        return view('backend.akreditasi.edit', compact('pageTitle', 'data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'mimes:pdf'
        ]);

        $data = Akreditasi::find($id);

        if ($request->hasFile('file')) {
            File::delete(public_path('/media/akreditasi/' . $data->file));
            $file = $request->file('file');
            $fileName = time(). '.'. $file->getClientOriginalName();
            $file->move(public_path('media/akreditasi'), $fileName);
        }

        $data->update([
            'content' => $request->content,
            'file' => $fileName ?? $request->current_file
        ]);

        Alert::success('File akreditasi successfully updated!');
        return redirect()->route('akreditasi.index');
    }

    public function destroy($id)
    {
        $data = Akreditasi::find($id);
        File::delete(public_path('/media/akreditasi/' . $data->file));
        $data->delete();

        Alert::success('File Akreditasi successfully deleted!');
        return redirect()->route('akreditasi.index');
    }
}
