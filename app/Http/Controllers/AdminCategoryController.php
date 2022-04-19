<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Categories;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Categories $category)
    {
        $this->authorize("isAdmin");

        $categories = Categories::all();
        $books = Books::all();

        return view("dashboard.categories.index",[
            "categories" => $categories,
            "books" => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.categories.create");
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
            "slug" => "required"
        ];

        $validatedData = $request->validate($rules);
        
        // $validatedData["id"] = $category[0]->id;
        
        Categories::create($validatedData);

        return redirect("/dashboard/categories")->with("success", "New category has been uploaded publicly !");
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
    public function edit($slug)
    {
        $category = Categories::where( "slug", $slug )->get();

        return view("dashboard.categories.edit", [
            "category_name" => $category[0]->name,
            "category_slug" => $category[0]->slug,
            // "categories" => Category::all(),
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
        $category = Categories::where( "slug", $slug )->get();
        $category_name = $category[0]->name;

        $rules = [
            "name" => "required|max:255",
            "slug" => "required"
        ];

        $validatedData = $request->validate($rules);
        
        $validatedData["id"] = $category[0]->id;
        
        Categories::where( "slug", $slug )->update($validatedData);

        return redirect("/dashboard/categories")->with("success", "[ $category_name ] has been updated publicly !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::where( "id", $id )->get();
        $category_name = $category[0]->name;

        $affected_books = Books::where("category_id", $id)->get();
        $total_affected_books = $affected_books->count();
        
        if ($total_affected_books > 0) {
            return redirect("/dashboard/categories")->with("failed", "There are $total_affected_books book(s) categorized as [ $category_name ] , can't delete this item !");
        } else {
            Categories::destroy($category);
        }

        return redirect("/dashboard/categories")->with("warning", "[ $category_name ] has been deleted !");
    }
}
