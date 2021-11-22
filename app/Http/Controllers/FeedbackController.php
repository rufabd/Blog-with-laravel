<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:sanctum",['except'=>["index","update","show"]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks=Feedback::with('user')->paginate(5);
        return response()->json([$feedbacks], 200);
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

        $feedback=Feedback::create([
            "body"=>$request->body,
            "user_id"=>auth()->user()->id
        ]);

        return response()->json(["feedback"=>$feedback], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feedback=Feedback::with('user')->find($id);
        if($feedback == null){
            return response()->json(["message"=>"The comment you would like to view doesn't exist"], 404);
        }
        return response()->json(["feedback"=>$feedback]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        if($feedback == null) {
            return response()->json(["Wrong method"=>"Delete is not supported for this route"], 405, []);
        }
        $feedback->delete();
        return response()->json([], 204);
    }
}
