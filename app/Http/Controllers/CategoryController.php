<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category=Category::all();
        return view('dashboard.category.index',['category'=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3|max:100',
            'description'=>'required|min:2'
        ]);
        $category = new Category();
        $category->name=$request->input('name');
        $category->description=$request->input('description');
        $category->save();
        return view("dashboard.category.message",['msg'=>"Categoria creada con exito"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //{{ ensayo de editor }}
        $category=Category::findOrFail($id);
        
        
        return view('dashboard.category.edit',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required|string|min:3',
            'description'=>'required|string|min:5'
        ]);
        $category=Category::findOrFail($id);
        $category->updated_at=now();
        $category->update($request->all());
        return view("dashboard.category.message",['msg'=>"Categoria actualizada con exito"]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publicaciones=Post::where('category_id',$id)->count();
        if ($publicaciones>0 ){
            return back()->with('status','No es posible eliminar, posee publicaciones');
            
        }else{

            $category=Category::findOrFail($id);
            $category->delete();
            return view("dashboard.category.message",['msg'=>"Categoria eliminada con exito"]);
        }

    }
}
