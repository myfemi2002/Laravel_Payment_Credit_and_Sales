<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use App\Models\User;
use DB;

class RolesController extends Controller
{
    public function rolesView() {
        $allData = Role::latest()->get();
        return view('backend.roles.index', compact('allData'));
    } // End Method

    public function rolesStore(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:roles',
        ],
        [
            'name.required' => 'Please Input Roles Name',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => "Roles Added Successfully",
            'alert-type' => 'success'
        );
        return Redirect()->route('roles.view')->with($notification);
    } // End Method

    public function rolesUpdate(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Please input the role name.',
        ]);

        try {
            // Find the role by ID
            $roles = Role::findOrFail($id);

            // Update the fields with the new values
            $roles->name = $request->name;
            $roles->updated_by = Auth::user()->id;
            $roles->updated_at = now();

            // Save the updated role
            $roles->save();

            $notification = [
                'message' => 'Role updated successfully.',
                'alert-type' => 'success',
            ];
            return back()->with($notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Failed to update role.',
                'alert-type' => 'error',
            ];
            return back()->with($notification);
        }
    } //End Method

    public function rolesDelete($id)
    {
        // Delete from the Database
        Role::find($id)->delete();
        $notification = [
            "message" => "Deleted Successfully",
            "alert-type" => "success",
        ];
        return Redirect()
            ->route("roles.view")
            ->with($notification);
    } // End Method

    // Add Role Permission
    public function rolesPermissionView(){
        $allData  = Role::all();
        return view('backend.roles.index_roles_permission',compact('allData'));
    } //End Method

    public function rolesPermissionAdd(){
        $role = Role::all();
        $permission = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('backend.roles.add_roles_permission',compact('role','permission','permission_groups'));
    }// End Method

    public function rolesPermissionStore(Request $request){
        $permissions = $request->input('permission');
        $role_id = $request->input('role_id');
        $existingRecords = [];

        foreach ($permissions as $permission) {
            $existingRecord = DB::table('role_has_permissions')
                ->where('role_id', $role_id)
                ->where('permission_id', $permission)
                ->first();

            if (!$existingRecord) {
                DB::table('role_has_permissions')->insert([
                    'role_id' => $role_id,
                    'permission_id' => $permission
                ]);
            } else {
                $existingRecords[] = $existingRecord;
            }
        }

        $notification = [
            'message' => 'Role permission added successfully',
            'alert-type' => 'success'
        ];

        if (count($existingRecords) > 0) {
            $notification['message'] .= ', but the following records already exist: ';
            foreach ($existingRecords as $record) {
                $role = DB::table('roles')->where('id', $record->role_id)->first();
                $permission = DB::table('permissions')->where('id', $record->permission_id)->first();
                $notification['message'] .= 'Role: '.$role->name.', Permission: '.$permission->name.'; ';
            }
            $notification['alert-type'] = 'warning';
        }
        return redirect()->route('roles.permission.view')->with($notification);
    }// End Method



    public function rolesPermissionEdit($id){
        $editData = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.roles.edit_role_permission',compact('editData','permissions','permission_groups'));
    } // End Method

    public function rolesPermissionUpdate(Request $request, $id){
        $editData = Role::findOrFail($id);
        $permissions = $request->input('permission', []);

        if (!empty($permissions)) {
        $editData->syncPermissions($permissions);
    }
    $notification = [
        'message' => 'Role permission updated successfully',
        'alert-type' => 'success'
    ];
    return redirect()->route('roles.permission.view')->with($notification);
    }// End Method

    public function rolesPermissionDelete($id){
        $role = Role::find($id);

        if (!$role) {
            $notification = [
            'message' => 'Role not found.',
            'alert-type' => 'danger',
        ];

        return redirect()->back()->with($notification);
    }

    $role->delete();

    $notification = [
        'message' => 'Role permission deleted successfully.',
        'alert-type' => 'success',
    ];

    return redirect()->back()->with($notification);
    }// End Method

}
