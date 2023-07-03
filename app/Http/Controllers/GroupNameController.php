<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupName;
use Illuminate\Support\Carbon;
use Auth;
use Image;

class GroupNameController extends Controller
{
    public function groupnameView(){
        $allData = GroupName::latest()->paginate(10);
        $colors = [
            "table-primary",
            "table-secondary",
            "table-success",
            "table-danger",
            "table-warning",
            "table-info",
            "table-light",
        ];
        return view("backend.groupname.index",compact("allData", "colors"));
    } // End Method


    public function groupnameStore(Request $request)
    {
        $validatedData = $request->validate(
            [
                "name" => "required|unique:group_names",
            ],
            [
                "name.required" => "Please input group name",
            ]
        );

        GroupName::insert([
            "name" => $request->name,
            "created_by" => Auth::user()->id,
            "created_at" => Carbon::now(),
        ]);

        $notification = [
            "message" => "Group Name added successfully",
            "alert-type" => "success",
        ];

        return back()->with($notification);
    } //End Method

    public function groupnameUpdate(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate(
            [
                "name" => "required|unique:group_names,name," . $id,
            ],
            [
                "name.required" => "Please input Group name",
            ]
        );

        try {
            // Find the group name by ID
            $groupName = GroupName::findOrFail($id);

            // Update the fields with the new values
            $groupName->name = $request->name;
            $groupName->updated_by = Auth::user()->id;
            $groupName->updated_at = Carbon::now();

            // Save the updated Group Name
            $groupName->save();

            $notification = [
                "message" => "Group Name updated successfully",
                "alert-type" => "success",
            ];
            return back()->with($notification);
        } catch (\Exception $e) {
            $notification = [
                "message" => "Failed to update group Name",
                "alert-type" => "error",
            ];
            return back()->with($notification);
        }
    } // End Method

    public function groupnameDelete($id)
    {
        // Delete from the Database
        GroupName::find($id)->delete();
        $notification = [
            "message" => "Deleted Successfully",
            "alert-type" => "success",
        ];
        return Redirect()
            ->route("groupname.view")
            ->with($notification);
    } // End Method

}
