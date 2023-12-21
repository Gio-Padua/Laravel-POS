<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Food;
use Illuminate\Http\Request;

class SaleController extends Controller
{
public function index(){
    return view("sales.index")->with([
        "categories" => Category::all(),
        "servants" => Employee::all(),
    ]);
}
}
