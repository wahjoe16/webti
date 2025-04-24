<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage Posts";

        // Pass the fetched posts to the view
        return view('backend.post.index', compact('pageTitle'));
    }

    public function dataPost()
    {
        // Fetch all posts from the database
        $posts = Post::with(['categories', 'user'])->latest()->get();
        // dd($posts);

        return datatables()
            ->of($posts)
            ->addIndexColumn()
            ->addColumn('visibility', function ($posts) {
                if($posts->visibility == 0) {
                    return 'Private';
                } else if($posts->visibility == 1) {
                    return 'Public';
                }
            })
            ->addColumn('featured_image', function ($posts){
                return '<img src="'. url('media/posts/'. $posts->featured_image). '" alt="Featured Image" width="100" />';
            })
            ->addColumn('aksi', function ($posts) {
                // $idx = $posts->id;
                return '
                    <a href="'. route('post.edit', $posts->id). '" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                    <a href="javascript:void(0)" data-id="' . $posts->id . '" id="btn-delete-post" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                ';
            })
            ->rawColumns(['featured_image', 'aksi', 'visibility'])
            ->make(true);
    }

    public function create()
    {
        $pageTitle = "Add new post";
        $category = Category::orderBy('name')->get();
        return view('backend.post.create', compact('pageTitle', 'category'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' =>'required|max:255',
            'content' =>'required',
            'category_id' =>'required|exists:categories,id',
            'featured_image' =>'required|image|mimes:jpg,jpeg,png',
            'status' =>'required|in:publish,draft',
            'visibility' =>'required',
            'post_date' => 'required'
        ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }

        // Upload the image to the storage directory
        $file = $request->file('featured_image');
        $imageName = time(). '_'. $file->getClientOriginalName();
        $path = public_path('media/posts');
        $file->move($path, $imageName);

        // define post date
        $date = $request->post_date;

        // Create a new post in the database
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'featured_image' => $imageName,
            // 'featured_image' => isset($imageName) ? $imageName : $post->featured_image,
            'slug' => $this->generateSlug($request->title),
            'post_date' => date('Y-m-d', strtotime($date)),
            'status' => $request->status,
            'visibility' => $request->visibility,
            'user_id' => auth()->user()->id,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
        ]);

        /*
        return response()->json([
            'success' => true,
            'message' => "Post created successfully!",
            'data' => $post
        ]);
        */
        Alert::success('Post successfully created!');
        return redirect()->route('post.index');
    }

    private function generateSlug($name, $id = null) 
    {
        $slug = Str::slug($name);
        $count = Post::where('slug', $slug)->when($id, function ($query, $id) {
            return $query->where('id', '!=', $id);
        })->count();

        if ($count > 0) {
            $slug = $slug. '-'. ($count + 1);
        }

        return $slug;
    }

    public function edit($id)
    {
        $pageTitle = "Edit post";
        $category = Category::orderBy('name')->get();
        $post = Post::with('categories')->find($id);
        return view('backend.post.edit', compact('pageTitle', 'category', 'post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        // Validate the form data
        $request->validate([
            'title' =>'required|max:255',
            'content' =>'required',
            'category_id' =>'required|exists:categories,id',
            'featured_image' =>'image|mimes:jpg,jpeg,png',
            'status' =>'required|in:publish,draft',
            'visibility' =>'required',
            'post_date' => 'required'
        ]);

        // Upload the image to the storage directory
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            if (!is_null($file)) {
                File::delete(public_path('/media/posts/' . $post->featured_image));
                $imageName = time(). '_'. $file->getClientOriginalName();
                $path = public_path('media/posts');
                $file->move($path, $imageName);
            }
        }

        // define post date
        $date = $request->post_date;
        // Update the post in the database
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'featured_image' => $imageName ?? $request->current_featured_image,
            'slug' => $this->generateSlug($request->title, $id),
            'post_date' => date('Y-m-d', strtotime($date)),
            'status' => $request->status,
            'visibility' => $request->visibility,
            'user_id' => auth()->user()->id,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
        ]);

        Alert::success('Post successfully updated!');
        return redirect()->route('post.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        // Delete the post from the database
        File::delete(public_path('/media/posts/'. $post->featured_image));
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post successfully deleted!'
        ]);
    }
}
