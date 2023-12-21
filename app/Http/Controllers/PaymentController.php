<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
 
    public function index()
    {
        //
        $sales = Payment::orderBy("created_at", "DESC")->paginate(10);
        return view("payment.index")->with([
            "payments" => $sales
        ]);
    }

   
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            "employee_id" => "required",
            "quantity" => "required|numeric",
            "total_price" => "required|numeric",
            "total_received" => "required|numeric",
            "change" => "required|numeric",
            "payment_type" => "required",
            "payment_status" => "required",
        ]);
        //store data
        $sale = new Payment();
        $sale->employee_id = $request->employee_id;
        $sale->quantity = $request->quantity;
        $sale->total_price = $request->total_price;
        $sale->total_received = $request->total_received;
        $sale->change = $request->change;
        $sale->payment_status = $request->payment_status;
        $sale->payment_type = $request->payment_type;
        $sale->save();
        $sale->foods()->sync($request->foods_id);
        //redirect user
        return redirect()->back()->with([
        ]);
    }

   
    public function show(Payment $sales)
    {
        //
    }

    public function edit($id)
    {
        //get sale to update
        $sales = Payment::findOrFail($id);
        //get sale tables
        //get table menus
        $menus = $sales->foods()->where('sales_id', $sales->id)->get();
        return view("sales.edit")->with([
            "payments" => $sales,
            "Employee" => Employee::all()
        ]);
    }


    public function update(Request $request, $id)
    {
        //validation
        $this->validate($request, [
            "food_id" => "required",
            "employee_id" => "required",
            "quantity" => "required|numeric",
            "total_price" => "required|numeric",
            "total_received" => "required|numeric",
            "change" => "required|numeric",
            "payment_type" => "required",
            "payment_status" => "required",
        ]);
        //get sale to update
        $sale = Payment::findOrFail($id);
        //update data
        $sale->employee_id = $request->employee_id;
        $sale->quantity = $request->quantity;
        $sale->total_price = $request->total_price;
        $sale->total_received = $request->total_received;
        $sale->change = $request->change;
        $sale->payment_status = $request->payment_status;
        $sale->payment_type = $request->payment_type;
        $sale->update();
        $sale->foods()->sync($request->food_id);
        //redirect user
        return redirect()->back()->with([
         
        ]);
    }

 
    public function destroy($id)
    {
        //get sale to update
        $sale = Payment::findOrFail($id);
        //delete sales
        $sale->delete();
        //redirect user
        return redirect()->back()->with([
           
        ]);
    }
}
