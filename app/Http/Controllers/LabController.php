<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class LabController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage Laboratoriums";
        // Fetch all the posts from the database
        $labs = Lab::with('user')->get();

        // Pass the fetched posts to the view
        return view('backend.lab.index', compact('pageTitle', 'labs'));
    }

    public function create()
    {
        $pageTitle = "Add New Laboratory";
        $kasie = User::where('type', '=', 'dosen')->orderBy('nik', 'DESC')->get();
        return view('backend.lab.create', compact('pageTitle', 'kasie'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' =>'required',
            'user_id' =>'required',
            'location' =>'required',
            'description' =>'required',
            
            'image_1' =>'required|image',
            'image_2' => 'image',
            'image_3' => 'image',
            'image_4' => 'image',
            'image_5' => 'image',
        ]);


        $file_1 = $request->file('image_1');
        $file_name_1 = time(). '-'. $file_1->getClientOriginalName();
        $path = public_path('media/labs');
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

        $file_4 = $request->file('image_4');
        if (!is_null($file_4)) {
            $file_name_4 = time(). '-'. $file_4->getClientOriginalName();
            $file_4->move($path, $file_name_4);
        }

        $file_5 = $request->file('image_5');
        if (!is_null($file_5)) {
            $file_name_5 = time(). '-'. $file_5->getClientOriginalName();
            $file_5->move($path, $file_name_5);
        }
        
        // dd($request);

        // Create a new post in the database
        Lab::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'location' => $request->location,
            'description' => $request->description,
            'image_1' => $file_name_1,
            'image_2' => $file_name_2 ?? null,
            'image_3' => $file_name_3 ?? null,
            'image_4' => $file_name_4 ?? null,
            'image_5' => $file_name_5 ?? null,
        ]);

        // Redirect to the post index page
        Alert::success('Laboratorium successfully created!');
        return redirect()->route('labs.index');
    }

    public function edit($id)
    {
        $pageTitle = "Edit Laboratorium";
        $kasie = User::get();
        $lab = Lab::with('user')->find($id);
        return view('backend.lab.edit', compact('pageTitle', 'kasie', 'lab'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' =>'required',
            'user_id' =>'required',
            'location' =>'required',
            'description' =>'required',
            'image_1' => 'image',
            'image_2' => 'image',
            'image_3' => 'image',
            'image_4' => 'image',
            'image_5' => 'image',
        ]);

        $lab = Lab::find($id);

        if ($request->hasFile('image_1')) {
            $file_1 = $request->file('image_1');
            if (!is_null($file_1)) {
                File::delete(public_path('/media/labs/' . $lab->image_1));
                $file_name_1 = time(). '-'. $file_1->getClientOriginalName();
                $path = public_path('media/labs');
                $file_1->move($path, $file_name_1);
            }
        }

        if ($request->hasFile('image_2')) {
            $file_2 = $request->file('image_2');
            if (!is_null($file_2)) {
                File::delete(public_path('/media/labs/' . $lab->image_2));
                $file_name_2 = time(). '-'. $file_2->getClientOriginalName();
                $path = public_path('media/labs');
                $file_2->move($path, $file_name_2);
            }
        }
        
        if ($request->hasFile('image_3')) {
            $file_3 = $request->file('image_3');
            if (!is_null($file_3)) {
                File::delete(public_path('/media/labs/' . $lab->image_3));
                $file_name_3 = time(). '-'. $file_3->getClientOriginalName();
                $path = public_path('media/labs');
                $file_3->move($path, $file_name_3);
            }
        }

        if ($request->hasFile('image_4')) {
            $file_4 = $request->file('image_4');
            if (!is_null($file_4)) {
                File::delete(public_path('/media/labs/' . $lab->image_4));
                $file_name_4 = time(). '-'. $file_4->getClientOriginalName();
                $path = public_path('media/labs');
                $file_4->move($path, $file_name_4);
            }
        }

        if ($request->hasFile('image_5')) {
            $file_5 = $request->file('image_5');
            if (!is_null($file_5)) {
                File::delete(public_path('/media/labs/' . $lab->image_5));
                $file_name_5 = time(). '-'. $file_5->getClientOriginalName();
                $path = public_path('media/labs');
                $file_5->move($path, $file_name_5);
            }
        }

        // Update the post in the database
        $lab->update([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'location' => $request->location,
            'description' => $request->description,
            'image_1' => $file_name_1 ?? $request->current_image_1,
            'image_2' => $file_name_2 ?? $request->current_image_2,
            'image_3' => $file_name_3 ?? $request->current_image_3,
            'image_4' => $file_name_4 ?? $request->current_image_4,
            'image_5' => $file_name_5 ?? $request->current_image_5,
        ]);

        // Redirect to the post index page
        Alert::success('Laboratorium successfully updated!');
        return redirect()->route('labs.index');
    }

    public function destroy($id)
    {
        $lab = Lab::find($id);

        File::delete(public_path('/media/labs/' . $lab->image_1));
        File::delete(public_path('/media/labs/' . $lab->image_2));
        File::delete(public_path('/media/labs/' . $lab->image_3));
        File::delete(public_path('/media/labs/' . $lab->image_4));
        File::delete(public_path('/media/labs/' . $lab->image_5));
        $lab->delete();

        // Redirect to the post index page
        Alert::success('Laboratorium successfully deleted!');
        return redirect()->route('labs.index');
    }
}
