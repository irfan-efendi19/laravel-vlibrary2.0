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
    public function show($slug)
    {
        $books = Books::where( "slug", $slug )->get();

        return view("dashboard.books.show", [
            "books" => $books,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $books = Books::where( "slug", $slug )->get();

        return view("dashboard.books.edit", [
            "books" => $books,
            "authors" => Authors::all(),
            "categories" => Categories::all(),
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
        $book = Books::where( "slug", $slug )->get();
        $book_title = $book[0]->title;

        $rules = [
            "title" => "required|max:255",
            "slug" => "required",
            "author_id" => "required",
            "category_id" => "required",
            "body" => "required",
            "publisher" => "required",
            "published_at" => "required",
            "total_pages" => "required",
            "total_units" => "required",
        ];

        $validatedData = $request->validate($rules);
        
        // $validatedData["id"] = $author[0]->id;
        
        Books::where( "slug", $slug )->update($validatedData);

        return redirect("/dashboard/books")->with("success", "[ $book_title ] has been updated publicly");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $books = Books::where( "slug", $slug )->get();

        $title = $books[0]->title;
        Books::destroy($books);

        return redirect("/dashboard/books")->with("warning", "[ $title ] has been deleted permanently !");
    }
}
