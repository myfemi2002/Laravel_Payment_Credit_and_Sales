<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\GroupName;
use Auth;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function permissionView() {
        $groupName = GroupName::latest()->get();
        $allData = Permission::latest()->get();
        return view('backend.permission.index', compact('allData','groupName'));
    } // End Method


    public function permissionstore(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:permissions',
            'group_name' => 'required',
        ],
        [
            'name.required' => 'Please Input Permission Name',
            'group_name.required' => 'Please Input group name',
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => "Permission Added Successfully",
            'alert-type' => 'success'
        );
        return Redirect()->route('permission.view')->with($notification);
    } // End Method

    public function permissionUpdate(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate(
            [
                "name" => "required|unique:permissions,name," . $id,
                'group_name' => 'required',
            ],
            [
                'name.required' => 'Please Input Permission Name',
                'group_name.required' => 'Please Input group name',
            ]
        );

        try {
            // Find the permission name by ID
            $permission = Permission::findOrFail($id);

            // Update the fields with the new values
            $permission->name = $request->name;
            $permission->group_name = $request->group_name;
            $permission->updated_by = Auth::user()->id;
            $permission->updated_at = Carbon::now();

            // Save the updated permission
            $permission->save();

            $notification = [
                "message" => "permission updated successfully",
                "alert-type" => "success",
            ];
            return back()->with($notification);
        } catch (\Exception $e) {
            $notification = [
                "message" => "Failed to update permission",
                "alert-type" => "error",
            ];
            return back()->with($notification);
        }
    } // End Method

    public function permissionDelete($id)
    {
        // Delete from the Database
        Permission::find($id)->delete();
        $notification = [
            "message" => "Deleted Successfully",
            "alert-type" => "success",
        ];
        return Redirect()
            ->route("permission.view")
            ->with($notification);
    } // End Method

}
