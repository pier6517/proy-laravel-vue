<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::with('category')->paginate(5);
        return view('dashboard.post.index',['post'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category=Category::all();
        return view('dashboard.post.create',['category'=>$category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3|max:100',
            'category_id'=>'required',
            'description'=>'required|min:2'
        ]);
        $post = new Post();
        $post->name=$request->input('name');
        $post->description=$request->input('description');
        $post->category_id=$request->input('category_id');
        $post->save();
        return view("dashboard.post.message",['msg'=>"Publicacion creada con exito"]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post=Post::find($id);
        return view('dashboard.post.edit',['post'=>$post, 'category'=>Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|min:3|max:100',
            'description'=>'required|min:2'
        ]);
        $post = Post::find($id);
        $post->name=$request->input('name');
        $post->description=$request->input('description');
        $post->category_id=$request->input('category');
        $post->save();
        return view("dashboard.post.message",['msg'=>"Publicacion modificada con exito"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $post->delete();
        return redirect("dashboard/post");
    }
}
