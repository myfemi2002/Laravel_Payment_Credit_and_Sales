<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamiliarGround;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use Auth;
use Image;


class CustomerController extends Controller
{
    public function customerView(){
        $familiarGround = FamiliarGround::latest()->get();
        $allData = Customer::latest()->get();
        return view('backend.customer.index',compact('familiarGround','allData'));
    } //End Method

    
    public function customerStore(Request $request)
    {
        $validatedData = $request->validate(
            [
                "customer_name" => "required",
                "customer_phone" => "required",
                "customer_gender" => "required",
                "familiar_ground_name" => "required",
                "customer_description" => "required",
            ],
            [
                "customer_name.required" => "Please input customer name",
                "customer_phone.required" => "Please input customer phone",
                "customer_gender.required" => "Please input customer gender",
                "familiar_ground_name.required" => "Please input familiar ground",
                "customer_description.required" => "Please input customer description",
            ]
        );

        Customer::insert([
        // $customer = Customer::create([
            "customer_name" => $request->customer_name,
            "customer_phone" => $request->customer_phone,
            "customer_gender" => $request->customer_gender,
            "familiar_ground_name" => $request->familiar_ground_name,
            "customer_description" => $request->customer_description,
            "status" => 'active',
            "created_by" => Auth::user()->id,
            "created_at" => Carbon::now(),
        ]);

        $notification = [
            "message" => "Customer added successfully",
            "alert-type" => "success",
        ];

        return back()->with($notification);
    } //End Method

    // public function customerUpdate(Request $request, $id)
    // {
    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'customer_name' => 'required',
    //         'customer_phone' => 'required',
    //         'familiar_ground_name' => 'required',
    //         'customer_description' => 'required',
    //     ]);
    
    //     try {
    //         // Find the record by ID
    //         $item = Customer::findOrFail($id);
    
    //         // Update the record with the validated data
    //         $item->update($validatedData);
            
    //         // Save the changes
    //         $item->save();
    
    //         $notification = [
    //             'message' => 'Customer updated successfully',
    //             'alert-type' => 'success',
    //         ];
    
    //         return redirect()->back()->with($notification);
    //     } catch (\Throwable $e) {
    //         $notification = [
    //             'message' => 'Failed to update customer',
    //             'alert-type' => 'error',
    //         ];
    
    //         return redirect()->back()->with($notification);
    //     }
    // }

    public function customerUpdate(Request $request, $id)
{
    // Validate the request data
    $validatedData = $request->validate([
        'customer_name' => 'required',
        'customer_phone' => 'required',
        'customer_gender' => 'required',
        'familiar_ground_name' => 'required',
        'customer_description' => 'required',
    ]);

    try {
        // Find the record by ID
        $item = Customer::findOrFail($id);

        // Update the record with the validated data
        $item->customer_name = $request->customer_name;
        $item->customer_phone = $request->customer_phone;
        $item->customer_gender = $request->customer_gender;
        $item->familiar_ground_name = $request->familiar_ground_name;
        $item->customer_description = $request->customer_description;
        $item->status =  $request->status;
        $item->created_by = Auth::user()->id;
        $item->updated_at = Carbon::now();

        // Save the changes
        $item->save();

        $notification = [
            'message' => 'Customer updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } catch (\Throwable $e) {
        $notification = [
            'message' => 'Failed to update customer',
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }
}

    
    
    
    
    

}
