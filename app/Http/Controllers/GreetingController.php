<?php

namespace App\Http\Controllers;

use App\Models\Greeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class GreetingController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage sambutan kaprodi";
        $data = Greeting::latest()->get();
        // dd($data);

        // Pass the fetched posts to the view
        return view('backend.greeting.index', compact('pageTitle', 'data'));
    }

    public function create()
    {
        $pageTitle = "Add new sambutan kaprodi";
        return view('backend.greeting.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            'message' =>'string',
            'photo' => 'image',
            'link' => 'string'
        ]);

        $image = $request->file('photo');
        $imageName = time(). '.'. $image->getClientOriginalName();
        $image->move(public_path('media/greeting'), $imageName);

        Greeting::create([
            'name' => $request->name,
            'message' => $request->message,
            'link' => $request->link,
            'photo' => $imageName
        ]);

        Alert::success('Sambutan kaprodi successfully added!');
        return redirect()->route('greetings.index');
    }

    public function edit($id)
    {
        $pageTitle = "Edit sambutan kaprodi";
        $greeting = Greeting::find($id);
        return view('backend.greeting.edit', compact('pageTitle', 'greeting'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            'message' =>'string',
            'photo' => 'image',
            'link' => 'string'
        ]);

        $greeting = Greeting::find($id);

        if ($request->hasFile('photo')) {
            File::delete(public_path('/media/greeting/' . $greeting->photo));
            $image = $request->file('photo');
            $imageName = time(). '.'. $image->getClientOriginalName();
            $image->move(public_path('media/greeting'), $imageName);
        }

        $greeting->update([
            'name' => $request->name,
            'message' => $request->message,
            'link' => $request->link,
            'photo' => $imageName?? $request->current_photo
        ]);

        Alert::success('Sambutan kaprodi successfully updated!');
        return redirect()->route('greetings.index');
    }

    public function destroy($id)
    {
        $greeting = Greeting::find($id);
        File::delete(public_path('/media/greeting/' . $greeting->photo));
        $greeting->delete();

        Alert::success('Sambutan kaprodi successfully deleted!');
        return redirect()->route('greetings.index');
    }
}
