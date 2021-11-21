<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum",['except'=>["index","update"]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments=Comment::with('user')->get();
        return response()->json([$comments], 200);
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
            "body"=>"required",
        ]);

        $comment=Comment::create([
            "body"=>$request->body,
            "user_id"=>auth()->user()->id
        ]);

        return response()->json(["comment"=>$comment], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment=Comment::with('user')->find($id);
        if($comment == null){
            return response()->json(["message"=>"The comment you would like to view doesn't exist"], 404);
        }
        return response()->json(["comment"=>$comment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment=Comment::with('user')->find($id);
        $comment->update($request->all());
        return response()->json(["comment"=>$comment,"message"=>"The comment has successfully been updated",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Comment::find($id) == null) {
            return response()->json(["Wrong method"=>"Delete is not supported for this route"], 405, []);
        }
        Comment::find($id)->delete();
        return response()->json(["success"=>true], 204);
    }
}
