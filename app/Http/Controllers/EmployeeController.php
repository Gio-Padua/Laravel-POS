<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
 
    public function index()
    {
        //
        return view("employee.index")->with([
            "employees" => Employee::paginate(5)
        ]);
    }


    public function create()
    {
        //
        return view("employee.add");
    }

   
    public function store(Request $request)
    {
        //
        //validation
        $this->validate($request, [
            "name" => "required|min:3"
        ]);
        //store data
        Employee::create([
            "name" => $request->name,
            "address" => $request->address
        ]);
        //redirect user
        return redirect()->route("employees.index")->with([
            "success" => "serveur ajouté avec succés"
        ]);
    }


    public function show(Employee $employee)
    {
        //
    }

    public function edit($id)
    {
        //
        return view("employee.edit")->with([
            "employee" => Employee::findOrFail($id)
        ]);
    }


    public function update(Request $request, $id)
    {
        //
        //validation
        $this->validate($request, [
            "name" => "required|min:3"
        ]);
        //update data
        $servant = Employee::findOrFail($id);
        $servant->update([
            "name" => $request->name,
            "address" => $request->address
        ]);
        //redirect user
        return redirect()->route("employees.index")->with([
        ]);
    }

   
    public function destroy($id)
    {
        $servant = Employee::findOrFail($id);
        $servant->delete();
        //redirect user
        return redirect()->route("employees.index")->with([
        ]);
    }
}
