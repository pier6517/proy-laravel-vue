<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\controller;


class ReplyController extends Controller
{
  

   function __construct()
   {


        $this->middleware('permission:reply-list|reply-create|reply-edit|reply-delete',['only'=>['index','show']]);
        $this->middleware('permission:reply-create',['only'=>['create','update']]);
        $this->middleware('permission:reply-edit',['only'=>['edit','update']]);
        $this->middleware('permission:reply-delete',['only'=>['destroy']]);
    }
   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $replies = Reply::with('post','author')->paginate(5);
       return view ('dashboard.replies.index', compact('replies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Post::all();
        return view('dashboard.replies.create',compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $author = auth()->user();
        $this->validate($request,[
            'post_id'=>'required',
            'content'=>'required'
        ]);

        $reply =Reply::create([
            'post_id'=>$request->post_id,
            'user_id'=>$author->id ?? null,
            'content'=>$request->content,
        ]);

        return redirect()->route('reply.index')->with('status','almacenada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reply $reply)
    {
        $reply =Reply::with('post');

        return view('dashboard.replies.edit', compact('reply'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reply $reply)
    {
      $user = auth()->user();
      $reply = Reply::with('post','author')->where('user_id',$user->id)->findOrFail($reply->id);
      
      $this->validate($request,[
        'content'=>'required',
      ]);
      $reply->update([
        'content'=>$request->content,
        'updated_at'=>now(),

      ]);
      return redirect()->route('reply.index')->with('status','actualizado correctamente');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reply $reply)
    {
        $user_id = auth()->user()->id;

       if($reply->author->id == $user_id)
       {
            $reply->delete();
            return redirect()->route('reply.index')->with('status','eliminada correctamente');
       }else {
        return redirect()->route('reply.index')->with('status','error no puede eliminar esta respuesta');
       }    
       
    }
    
}
