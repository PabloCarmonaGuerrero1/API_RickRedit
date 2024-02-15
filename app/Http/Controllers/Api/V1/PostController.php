<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $request->validated();
        $user = Auth::user();
        $post = new Post();
        $post->user()->associate($user); 
    
        $url_image = $this->upload($request->file('image'));
        $post->image = $url_image;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        
        $res = $post->save();
        
        if ($res) {
            return response()->json(['message' => 'Post created successfully'], 201);
        }
        
        return response()->json(['message' => 'Error creating post'], 500);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
    public function __construct()
{
$this->middleware('auth:api', ['except' => ['index', 'show']]);
}
private function upload($image)
{
$path_info = pathinfo($image->getClientOriginalName());
$post_path = 'images/post';
$rename = uniqid() . '.' . $path_info['extension'];
$image->move(public_path() . "/$post_path", $rename);
return "$post_path/$rename";
}
}
