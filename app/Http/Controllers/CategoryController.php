<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum",['except'=>["index","show","store","update","destroy"]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categories=Category::with('blogPosts')->paginate(5);
        // if($categories = null) {
        //     return response()->json(["message"=>"The category you are looking for doesn't exist"], 404);
        // }
        return response()->json([$categories], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"=>"required",
        ]);
        $category=Category::create([
            "title"=>$request->title
            // "noOfBlogs"=>$request->noOfBlogs
        ]);

        return response()->json(["category"=>$category,], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category=Category::with('blogPosts')->find($id);
        if(Category::find($id) == null){
            return response()->json(["message"=>"The category doesn't exist!"], 404);
        } else {
            return response()->json(["category"=>$category], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category=Category::with('blogPosts')->find($id);
        $category->update($request->all());
        return response()->json(["category"=>$category,"message"=>"The category has successfully been updated",], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->blogPosts()->delete();
        $category->delete();
        return response()->json([], 204);
    }
}
