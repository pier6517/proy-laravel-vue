<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Request\StorePost;

class PostController extends Controller
{
    function __construct()
        {
        $this->middleware('permission:ver-post|crear-post|editar-post|borrar-post',['only'=>['index','show']]);
        $this->middleware('permission:crear-post',['only'=>['create','store']]);
        $this->middleware('permission:editar-post',['only'=>['edit','update']]);
        $this->middleware('permission:borrar-post',['only'=>['destroy']]);

        }
    
    public function index()
    {
        $posts=Post::with('category','author','replies')->paginate(5);
        return view('dashboard.post.index',['posts'=>$posts]);
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
        $user = auth()->user();
        $request->validate([
            'name'=>'required|min:3|max:100',
            'category_id'=>'required',
            'description'=>'required|min:2'
        ]);
        $post = new Post();
        $post->name=$request->input('name');
        $post->description=$request->input('description');
        $post->category_id=$request->input('category_id');
        $post->author_id = $user->id;
        $post->save();
        return view("dashboard.post.message",['msg'=>"Publicacion creada con exito"]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $user = auth()->user();

        if($user->hasRole('administrador')){
            $post-load('category','author','replies.author');

        }else{
            $post->load('category','author','replies.author')->where('user_id',$user->id);

        }
       return response()->json($post);
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
    public function destroy(Post $post)
    {
$user =auth()->user();
if($user->id != $post->author_id){
   return back()->with('status','No puede eliminar ');    
}else if($post->replies->count() > 0){
    return back()->with('status','No puede elimiar');
}else{

        $post=Post::find($post->id);
        $post->delete();
        return redirect()->route('post.index')->with('status',"publicacion eliminada");
    }
}
}