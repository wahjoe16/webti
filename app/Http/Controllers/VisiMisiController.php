<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class VisiMisiController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage Visi Misi";
        // Fetch all the posts from the database
        $data = VisiMisi::get();

        // Pass the fetched posts to the view
        return view('backend.visi-misi.index', compact('pageTitle', 'data'));
    }

    public function create()
    {
        $pageTitle = "Add New Visi Misi";
        return view('backend.visi-misi.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'content' =>'required',
            'image_1' =>'required|image',
            'image_2' => 'image',
            'image_3' => 'image'
        ]);


        $file_1 = $request->file('image_1');
        $file_name_1 = time(). '-'. $file_1->getClientOriginalName();
        $path = public_path('media/visi-misi');
        $file_1->move($path, $file_name_1);
        
        $file_2 = $request->file('image_2');
        if (!is_null($file_2)) {
            $file_name_2 = time(). '-'. $file_2->getClientOriginalName();
            $file_2->move($path, $file_name_2);
        }

        $file_3 = $request->file('image_3');
        if (!is_null($file_3)) {
            $file_name_3 = time(). '-'. $file_3->getClientOriginalName();
            $file_3->move($path, $file_name_3);
        }
        
        // Create a new history in the database
        VisiMisi::create([
            'content' => $request->content,
            'image_1' => $file_name_1,
            'image_2' => $file_name_2 ?? null,
            'image_3' => $file_name_3 ?? null
        ]);

        // Redirect to the post index page
        Alert::success('Visi misi successfully created!');
        return redirect()->route('visi-misi.index');
    }

    public function edit($id)
    {
        $pageTitle = "Edit Visi Misi";
        $data = VisiMisi::find($id);
        return view('backend.visi-misi.edit', compact('pageTitle', 'data'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'content' =>'required',
            'image_1' =>'required|image',
            'image_2' => 'image',
            'image_3' => 'image'
        ]);

        $data = VisiMisi::find($id);

        if ($request->hasFile('image_1')) {
            $file_1 = $request->file('image_1');
            if (!is_null($file_1)) {
                File::delete(public_path('/media/visi-misi/' . $data->image_1));
                $file_name_1 = time(). '-'. $file_1->getClientOriginalName();
                $path = public_path('media/visi-misi');
                $file_1->move($path, $file_name_1);
            }
        }

        if ($request->hasFile('image_2')) {
            $file_2 = $request->file('image_2');
            if (!is_null($file_2)) {
                File::delete(public_path('/media/visi-misi/' . $data->image_2));
                $file_name_2 = time(). '-'. $file_2->getClientOriginalName();
                $path = public_path('media/visi-misi');
                $file_2->move($path, $file_name_2);
            }
        }
        
        if ($request->hasFile('image_3')) {
            $file_3 = $request->file('image_3');
            if (!is_null($file_3)) {
                File::delete(public_path('/media/visi-misi/' . $data->image_3));
                $file_name_3 = time(). '-'. $file_3->getClientOriginalName();
                $path = public_path('media/visi-misi');
                $file_3->move($path, $file_name_3);
            }
        }

        // Update the post in the database
        $data->update([
            'content' => $request->content,
            'image_1' => $file_name_1 ?? $data->image_1,
            'image_2' => $file_name_2 ?? null,
            'image_3' => $file_name_3 ?? null
        ]);

        // Redirect to the post index page
        Alert::success('Visi Misi successfully updated!');
        return redirect()->route('visi-misi.index');
    }

    public function destroy($id)
    {
        $data = VisiMisi::find($id);

        File::delete(public_path('/media/visi-misi/' . $data->image_1));
        File::delete(public_path('/media/visi-misi/' . $data->image_2));
        File::delete(public_path('/media/visi-misi/' . $data->image_3));
        $data->delete();

        // Redirect to the post index page
        Alert::success('Visi Misi successfully deleted!');
        return redirect()->route('visi-misi.index');
    }
}
