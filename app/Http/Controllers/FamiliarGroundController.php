<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamiliarGround;
use Illuminate\Support\Carbon;
use Auth;
use Image;

class FamiliarGroundController extends Controller
{
        public function FamiliarGroundView(){

            $allData = FamiliarGround::latest()->paginate(10);
            $colors = [
                "table-primary",
                "table-secondary",
                "table-success",
                "table-danger",
                "table-warning",
                "table-info",
                "table-light",
            ];
            return view(
                "backend.familiar_ground.index",
                compact("allData", "colors")
            );
        } // End Method

        public function FamiliarGroundStore(Request $request)
        {
            $validatedData = $request->validate(
                [
                    "familiar_ground_name" => "required|unique:familiar_grounds",
                ],
                [
                    "familiar_ground_name.required" =>
                        "Please input familiar ground",
                ]
            );

            FamiliarGround::insert([
                "familiar_ground_name" => $request->familiar_ground_name,
                "created_by" => Auth::user()->id,
                "created_at" => Carbon::now(),
            ]);

            $notification = [
                "message" => "Familiar Ground added successfully",
                "alert-type" => "success",
            ];

            return back()->with($notification);
        } //End Method


        public function FamiliarGroundUpdate(Request $request, $id)
        {
            // Validate the request data
            $validatedData = $request->validate(
                [
                    "familiar_ground_name" => "required|unique:familiar_grounds,familiar_ground_name," . $id,
                ],
                [
                    "familiar_ground_name.required" => "Please input familiar ground name",
                ]
            );

            try {
                // Find the familiar ground name by ID
                $familiarGround = FamiliarGround::findOrFail($id);

                // Update the fields with the new values
                $familiarGround->familiar_ground_name = $request->familiar_ground_name;
                $familiarGround->updated_by = Auth::user()->id;
                $familiarGround->updated_at = Carbon::now();

                // Save the updated familiar ground
                $familiarGround->save();

                $notification = [
                    "message" => "familiar ground updated successfully",
                    "alert-type" => "success",
                ];
                return back()->with($notification);
            } catch (\Exception $e) {
                $notification = [
                    "message" => "Failed to update familiar ground",
                    "alert-type" => "error",
                ];
                return back()->with($notification);
            }
        } // End Method

        public function FamiliarGroundDelete($id)
        {
            // Delete from the Database
            FamiliarGround::find($id)->delete();
            $notification = [
                "message" => "Deleted Successfully",
                "alert-type" => "success",
            ];
            return Redirect()
                ->route("familiar-ground.view")
                ->with($notification);
        } // End Method
}
