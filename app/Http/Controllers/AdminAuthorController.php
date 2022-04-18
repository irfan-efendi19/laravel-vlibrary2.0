<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;

class AdminAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("isAdmin");

        return view("dashboard.authors.index",[
            "authors" => Authors::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.authors.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            "name" => "required|max:255",
            "slug" => "required",
            "region" => "required"
        ];

        $validatedData = $request->validate($rules);
        
        // $validatedData["id"] = $category[0]->id;
        
        Authors::create($validatedData);

        return redirect("/dashboard/authors")->with("success", "New author has been provided publicly !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Authors::where("slug", $id)->get();

        return view("dashboard.authors.edit", [
            "author" => $author
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $author = Authors::where( "slug", $slug )->get();
        $author_name = $author[0]->name;

        $rules = [
            "name" => "required|max:255",
            "region" => "required",
            "slug" => "required"
        ];

        $validatedData = $request->validate($rules);
        
        $validatedData["id"] = $author[0]->id;
        
        Authors::where( "slug", $slug )->update($validatedData);

        return redirect("/dashboard/authors")->with("success", "[ $author_name ] has been updated publicly !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $author = Authors::where( "slug", $slug )->get();
        $author_name = $author[0]->name;

        Authors::destroy($author);

        return redirect("/dashboard/authors")->with("warning", "[ $author_name ] has been deleted !");
    }
}
