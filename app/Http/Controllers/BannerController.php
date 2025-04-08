<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class BannerController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage Banner";

        // Fetch banners from the database
        $data = Banner::latest()->get();

        return view('backend.banner.index', compact('data', 'pageTitle'));
    }

    public function create()
    {
        $pageTitle = "Create New Banner";

        return view('backend.banner.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'caption' =>'required',
            'link' => 'nullable|url',
            'image_1' =>'required|image|mimes:jpeg,jpg,png',
            'image_2' => 'image|mimes:jpeg,jpg,png',
            'image_3' => 'image|mimes:jpeg,jpg,png',
            'image_4' => 'image|mimes:jpeg,jpg,png',
        ]);


        $file_1 = $request->file('image_1');
        $file_name_1 = time(). '-'. $file_1->getClientOriginalName();
        $path = public_path('media/banner');
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

        // Create a new post in the database
        Banner::create([
            'caption' => $request->caption,
            'link' => $request->link,
            'image_1' => $file_name_1,
            'image_2' => $file_name_2 ?? null,
            'image_3' => $file_name_3 ?? null,
            'image_4' => $file_name_4 ?? null,
        ]);

        // Redirect to the post index page
        Alert::success('Banner successfully created!');
        return redirect()->route('banner.index');
    }

    public function edit($id)
    {
        $pageTitle = "Edit banner";
        $data = Banner::find($id);
        return view('backend.banner.edit', compact('pageTitle', 'data'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'caption' =>'required',
            'link' => 'nullable|url',
            'image_1' => 'image|mimes:jpeg,jpg,png|max:2048',
            'image_2' => 'image|mimes:jpeg,jpg,png|max:2048',
            'image_3' => 'image|mimes:jpeg,jpg,png|max:2048',
            'image_4' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $banner = Banner::find($id);

        if ($request->hasFile('image_1')) {
            $file_1 = $request->file('image_1');
            if (!is_null($file_1)) {
                File::delete(public_path('/media/banner/' . $banner->image_1));
                $file_name_1 = time(). '-'. $file_1->getClientOriginalName();
                $path = public_path('media/banner');
                $file_1->move($path, $file_name_1);
            }
        }

        if ($request->hasFile('image_2')) {
            $file_2 = $request->file('image_2');
            if (!is_null($file_2)) {
                File::delete(public_path('/media/banner/' . $banner->image_2));
                $file_name_2 = time(). '-'. $file_2->getClientOriginalName();
                $path = public_path('media/banner');
                $file_2->move($path, $file_name_2);
            }
        }
        
        if ($request->hasFile('image_3')) {
            $file_3 = $request->file('image_3');
            if (!is_null($file_3)) {
                File::delete(public_path('/media/banner/' . $banner->image_3));
                $file_name_3 = time(). '-'. $file_3->getClientOriginalName();
                $path = public_path('media/banner');
                $file_3->move($path, $file_name_3);
            }
        }

        if ($request->hasFile('image_4')) {
            $file_4 = $request->file('image_4');
            if (!is_null($file_4)) {
                File::delete(public_path('/media/banner/' . $banner->image_4));
                $file_name_4 = time(). '-'. $file_4->getClientOriginalName();
                $path = public_path('media/banner');
                $file_4->move($path, $file_name_4);
            }
        }

        // Update the post in the database
        $banner->update([
            'caption' => $request->caption,
            'link' => $request->link,
            'image_1' => $file_name_1 ?? $banner->image_1,
            'image_2' => $file_name_2 ?? $banner->image_2,
            'image_3' => $file_name_3 ?? $banner->image_3,
            'image_4' => $file_name_4 ?? $banner->image_4,
        ]);

        // Redirect to the post index page
        Alert::success('Banner successfully updated!');
        return redirect()->route('banner.index');
    }

    public function destroy($id)
    {
        $banner = Banner::find($id);

        // Delete the post from the database
        File::delete(public_path('/media/banner/'. $banner->image_1));
        File::delete(public_path('/media/banner/'. $banner->image_2?? null));
        File::delete(public_path('/media/banner/'. $banner->image_3?? null));
        File::delete(public_path('/media/banner/'. $banner->image_4?? null));
        $banner->delete();

        // Redirect to the post index page
        Alert::success('Banner successfully deleted!');
        return redirect()->route('banner.index');
    }
}
