<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function index()
    {
        //
        return view("category.index")->with([
            'categories'=>Category::paginate(5)
        ]);
    }

   
    public function create()
    {
        //
        return view("category.add");
    }

    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            "title" => "required|min:3"
        ]);
        //store data
        $title = $request->title;
        Category::create([
            "title" => $title,
            "slug" => Str::slug($title)
        ]);
        //redirect user
        return redirect()->route("categories.index")->with([
            "success" => "category added successfully"
        ]);
    }


    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //
        return view("category.edit")->with([
            "category" => $category
        ]);
    }


    public function update(Request $request, Category $category)
    {
        //validation
        $this->validate($request, [
            "title" => "required|min:3"
        ]);
        //store data
        $title = $request->title;
        $category->update([
            "title" => $title,
            "slug" => Str::slug($title)
        ]);
        //redirect user
        return redirect()->route("categories.index")->with([
            "success" => "Sucessfuly modified"
        ]);
    }

    
    public function destroy(Category $category)
    {
        //delete category
        $category->delete();
        //redirect user
        return redirect()->route("categories.index")->with([
            "success" => "catégorie supprimée avec succés"
        ]);
    }
}
