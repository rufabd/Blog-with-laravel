<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum",['except'=>["index","search","store",
        "update","destroy","show"]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogPosts=BlogPost::with('category')->get();
        return response()->json([$blogPosts], 200);
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
            "body"=>"required",
            "imageLink"=>"required",
            "author"=>"required",
            "date"=>"required",
            "time"=>"required",
            "category_id"=>"required"
        ]);

        $blogPost=BlogPost::create([
            "title"=>$request->title,
            "body"=>$request->body,
            "imageLink"=>$request->imageLink,
            "author"=>$request->author,
            "date"=>$request->date,
            "time"=>$request->time,
            "category_id"=>$request->category_id
        ]);

        return response()->json(["blogPost"=>$blogPost], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blogPost=BlogPost::with('category')->find($id);
        if($blogPost == null) {
            return response()->json(["message"=>"The Blog post doesn't exist!"],404);
        } else {
            return response()->json(["post"=>$blogPost,]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blogPost=BlogPost::with('category')->find($id);
        $blogPost->update($request->all());
        return response()->json(["blogPost"=>$blogPost,"message"=>"Post has been successfully updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BlogPost::find($id)->delete();
        return response()->json(["message"=>"Post has been successfully deleted!"],204);
    }

    public function search($title)
    {
        return BlogPost::where('title', 'like', '%'.$title.'%')->get();
    }
}
