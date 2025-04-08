<?php

namespace App\Http\Controllers;

use Stringable;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = "Manage Categories";
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('backend.category.index', compact('pageTitle', 'categories'));
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
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = Category::create([
            'name' => $request->name,
            'slug' => $this->generateSlug($request->name),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category successfully created',
            'data' => $category
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Category::find($id);
        return response()->json([
            'success' => true,
            'message' => "Detail detail category",
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
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // $category = Category::find($id);
        // $category->name = $request->name;
        // $category->slug = $this->generateSlug($request->name, $id);
        // $category->save();

        $category->update([
            'name' => $request->name,
            'slug' => $this->generateSlug($request->name, $category),
        ]);

        // $category = Category::find($id);
        // $category->update(['name' => $request->name]);
        // $category->slug = $this->generateSlug($request->name, $id);
        // $category->save();

        return response()->json([
           'success' => true,
           'message' => 'Category successfully updated',
           'data' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Category::find($id);
        $data->delete();

        return response()->json([
           'success' => true,
           'message' => 'Category successfully deleted!'
        ]);
    }

    private function generateSlug($name, $id = null)
    {
        $slug = Str::slug($name);
        $count = Category::where('slug', $slug)->when($id, function($query, $id){
            return $query->where('id', '!=', $id);
        })->count();

        if ($count > 0) {
            $slug = $slug. '-'. ($count + 1);
        }

        return $slug;
    }
}
