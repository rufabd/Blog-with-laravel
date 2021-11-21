<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
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
        $contact=Contact::all();
        return response()->json(["contact"=>$contact], 200);
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
            "subject"=>"required",
            "message"=>"required"
        ]);

        $contact=Contact::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "subject"=>$request->subject,
            "message"=>$request->message,
            // "user_id"=>auth()->user()->id
        ]);

        return response()->json(["contact"=>$contact], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact=Contact::find($id);
        if(Contact::find($id) == null){
            return response()->json(["message"=>"Unable to send! Try again"],404);
        } else {
            return response()->json(["contact"=>$contact,], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Contact::find($id) == null) {
            return response()->json(["Wrong method"=>"Delete is not supported for this route"], 405, []);
        }
        Contact::find($id)->delete();
        return response()->json([], 204);
    }
}
