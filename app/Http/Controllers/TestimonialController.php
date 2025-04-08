<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class TestimonialController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage testimonials";
        $data = Testimonial::latest()->get();
        // dd($data);

        // Pass the fetched posts to the view
        return view('backend.testimonial.index', compact('pageTitle', 'data'));
    }

    public function create()
    {
        $pageTitle = "Add new testimonial";
        return view('backend.testimonial.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            'jurusan_angkatan' =>'required|string|max:255',
            'content' =>'required|string',
            'photo' => 'required|image',
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255'
        ]);

        $image = $request->file('photo');
        $imageName = time(). '.'. $image->getClientOriginalName();
        $image->move(public_path('media/testimonial'), $imageName);

        Testimonial::create([
            'name' => $request->name,
            'jurusan_angkatan' => $request->jurusan_angkatan,
            'content' => $request->content,
            'photo' => $imageName,
            'company' => $request->company,
            'position' => $request->position
        ]);

        Alert::success('Testimonial successfully added!');
        return redirect()->route('testimonials.index');
    }

    public function edit($id)
    {
        $pageTitle = "Edit testimonial";
        $testimonial = Testimonial::find($id);
        return view('backend.testimonial.edit', compact('pageTitle', 'testimonial'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            'jurusan_angkatan' =>'required|string|max:255',
            'content' =>'required|string',
            'photo' => 'nullable|image',
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255'
        ]);

        $testimonial = Testimonial::find($id);

        if ($request->hasFile('photo')) {
            File::delete(public_path('/media/testimonial/' . $testimonial->photo));
            $image = $request->file('photo');
            $imageName = time(). '.'. $image->getClientOriginalName();
            $image->move(public_path('media/testimonial'), $imageName);
        }

        $testimonial->update([
            'name' => $request->name,
            'jurusan_angkatan' => $request->jurusan_angkatan,
            'content' => $request->content,
            'photo' => $imageName?? $testimonial->photo,
            'company' => $request->company,
            'position' => $request->position
        ]);

        Alert::success('Testimonial successfully updated!');
        return redirect()->route('testimonials.index');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        File::delete(public_path('/media/testimonial/' . $testimonial->photo));
        $testimonial->delete();

        Alert::success('Testimonial successfully deleted!');
        return redirect()->route('testimonials.index');
    }
}
