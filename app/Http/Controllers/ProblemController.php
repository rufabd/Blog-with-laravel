<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum",['except'=>["index","update","store","show","destroy"]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $problems=Problem::with('user')->get();
        // return response()->json([$problems], 200);

        $problem=Problem::paginate(5);
        return response()->json(["problem"=>$problem], 200);
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
            "name"=>"required",
            "email"=>"required",
            "body"=>"required",
        ]);

        $problem=Problem::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "body"=>$request->body,
            // "user_id"=>auth()->user()->id
        ]);

        return response()->json(["problem"=>$problem], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $problem=Problem::with('user')->find($id);
        // if($problem == null){
        //     return response()->json(["message"=>"The comment you would like to view doesn't exist"], 404);
        // }
        // return response()->json(["problem"=>$problem]);

         $problem=Problem::find($id);
        if(Problem::find($id) == null){
            return response()->json(["message"=>"Unable to send! Try again"],404);
        } else {
            return response()->json(["problem"=>$problem,]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function edit(Problem $problem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Problem $problem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Problem::find($id) == null) {
            return response()->json(["Wrong method"=>"Delete is not supported for this route"], 405, []);
        }
        Problem::find($id)->delete();
        return response()->json(["success"=>true], 204);
    }
}
