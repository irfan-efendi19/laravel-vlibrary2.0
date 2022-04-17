<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use App\Models\Categories;
use Illuminate\Http\Request;

class AdminBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.books.index", [
            "books" => Books::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.books.create", [
            "categories" => Categories::all(),
            "authors" => Authors::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "title" => "required|max:255",
            "author_id" => "required|max:255",
            "slug" => "required|unique:books",
            "publisher" => "required|max:255",
            "published_at" => "required|max:4",
            "total_pages" => "required",
            "total_units" => "required",
            "category_id" => "required",
            "image" => "image|file|max:1024",
            "body" => "required"
        ]);

        if($request->file('image')) {
            $validatedData["image"] = $request->file("image")->store('books-image');
        }
        
        Books::create($validatedData);

        return redirect("/dashboard/books")->with("success", "A new book has been provided publicly !");
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
