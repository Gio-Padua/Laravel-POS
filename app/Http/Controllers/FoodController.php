<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class FoodController extends Controller
{
    public function __construct()
    {
    }


    public function index()
    {
        //
        return view("menu.index")->with([
            "menus" => Food::paginate(5)
        ]);
    }


    public function create()
    {
        //
        $this->authorize('create', Food::class);
        return view("menu.add")->with([
            "categories" => Category::all()
        ]);
    }

    public function store(Request $request)
    {
       
        //validation
        $this->validate($request, [
            "name" => "required|min:3|",
            "image" => "required|image|mimes:png,jpg,jpeg|max:2048",
            "price" => "required|numeric",
            "description" => "required|min:5",
            "category_id" => "required|numeric",
        ]);
        //store data
        if ($request->hasFile("image")) {
            $file = $request->image;
            $imageName = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images/menu'), $imageName);
            $name = $request->name;
            Food::create([
                "name" => $name,
                "slug" => Str::slug($name),
                "image" =>  $imageName,
                "price" =>  $request->price,
                "description" =>  $request->description,
                "category_id" =>  $request->category_id,
                
            ]);
            //redirect user
            return redirect()->route("menu.index");
        }
    }

 
    public function show(Food $food)
    {
        //
    }


    public function edit(Food $menu)
    {
        //
        return view("menu.edit")->with([
            "categories" => Category::all(),
            "menu" => $menu
        ]);
    }


    public function update(Request $request, Food $menu)
    {
        //
        //validation
        $this->validate($request, [
            "name" => "required|min:3,name" . $menu->id,
          
            "image" => "image|mimes:png,jpg,jpeg|max:2048",
            "price" => "required|numeric",
            "description" => "required|min:5",
            "category_id" => "required|numeric",
        ]);
        //store data
        if ($request->hasFile("image")) {
            unlink(public_path('images/menu/' . $menu->image));
            $file = $request->image;
            $imageName = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images/menu'), $imageName);
            $name = $request->name;
            $menu->update([
                "name" => $name,
                "slug" => Str::slug($name),
                "image" =>  $imageName,
                "price" =>  $request->price,
                "description" =>  $request->description,
                "category_id" =>  $request->category_id,
            ]);
            //redirect user
            return redirect()->route('menu.index');
        } else {
            $name = $request->name;
            $menu->update([
                "name" => $name,
                "slug" => Str::slug($name),
                
                "price" =>  $request->price,
                "description" =>  $request->description,
                "category_id" =>  $request->category_id
            ]);
            //redirect user
            return redirect()->route('menu.index');
        }
    }

  
    public function destroy(Food $food)
    {
        //remove image
        unlink(public_path('images/menu/' . $food->image));
        $food->delete();
        //redirect user
        return redirect()->route("menu.index")->with([
            
        ]);
    }
}
