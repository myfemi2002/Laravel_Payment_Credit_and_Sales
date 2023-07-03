<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenditure;
use Illuminate\Support\Carbon;
use Auth;

class ExpenditureController extends Controller
{
    public function expenditureView (){
        $allData = Expenditure::latest()->get();
        return view("backend.expenditures.index",compact("allData"));
    } // End Method

    public function expenditureStore(Request $request)
    {
        $validatedData = $request->validate([
            'expenditure_name' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'date' => 'required',
        ]);

        Expenditure::insert([
            "expenditure_name" => $request->expenditure_name,
            "date" => \Carbon\Carbon::parse($request->input('date'))->format('Y-m-d'),
            "amount" => $request->amount,
            "description" => $request->description,
            "created_by" => Auth::user()->id,
            "created_at" => Carbon::now(),
        ]);

        $notification = [
            "message" => "Record added successfully",
            "alert-type" => "success",
        ];

        return back()->with($notification);
    } //End Method

    public function expenditureUpdate(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate(
            [
                'expenditure_name' => 'required',
                'amount' => 'required',
                'description' => 'required',
                'date' => 'required',
            ],
            [
                "expenditure_name.required" => "Please input expenditure name",
                "amount.required" => "Please input amount",
                "description.required" => "Please input description",
                "date.required" => "Please input date",
            ]
        );

        try {
            // Find the expenditure name by ID
            $expenditure = Expenditure::findOrFail($id);

            // Update the fields with the new values
            $expenditure->expenditure_name = $request->expenditure_name;
            $expenditure->amount = $request->amount;
            $expenditure->description = $request->description;
            $expenditure->date = \Carbon\Carbon::parse($request->input('date'))->format('Y-m-d');
            $expenditure->updated_by = Auth::user()->id;
            $expenditure->updated_at = Carbon::now();

            // Save the updated familiar ground
            $expenditure->save();

            $notification = [
                "message" => "Record updated successfully",
                "alert-type" => "success",
            ];
            return back()->with($notification);
        } catch (\Exception $e) {
            $notification = [
                "message" => "Failed to update Record",
                "alert-type" => "error",
            ];
            return back()->with($notification);
        }
    } // End Method

    public function expenditureDelete($id)
    {
        // Delete from the Database
        Expenditure::find($id)->delete();
        $notification = [
            "message" => "Deleted Successfully",
            "alert-type" => "success",
        ];
        return Redirect()
            ->route("expenditure.view")
            ->with($notification);
    } // End Method

}
