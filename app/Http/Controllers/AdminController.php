<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;
use Image;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\Product;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AdminDashboard(){
        $customers = DB::table('customers')->orderBy('customer_name','DESC')->get();

        //Calculate Progress Percentage
        $totalCustomers = count($customers);
        $maximumCustomers = 100; // Adjust this value based on your requirements
        $progressPercentage = $totalCustomers > 0 ? ($totalCustomers / $maximumCustomers) * 100 : 0;

        //Since Last Week Starts

        // Calculate the start and end dates of last week
        $startDate = Carbon::now()->subWeek()->startOfWeek();
        $endDate = Carbon::now()->subWeek()->endOfWeek();

        // Get the count of customers created within the last week
        $customerCount = DB::table('customers')->whereBetween('created_at', [$startDate, $endDate])->count();

        // Calculate the since last week progress percentage
        $totalCustomers = 100; // Set the maximum number of customers you want to represent as 100%
        $weeklyProgressPercentage = $customerCount > 0 ? ($customerCount / $totalCustomers) * 100 : 0;
        //Since Last Week Ends

        // Retrieve the current total amount paid from the payments table
        $currentTotalAmountPaid = Payment::sum('amount_paid');

        // Calculate the start and end dates for last week
        $startDateLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endDateLastWeek = Carbon::now()->subWeek()->endOfWeek();

        // Retrieve the total amount paid last week using the created_at timestamp
        $lastWeekTotalAmountPaid = Payment::whereBetween('created_at', [$startDateLastWeek, $endDateLastWeek])->sum('total_amount_paid');

        // Calculate the progress percentage
        $weeklyTotalAmountPaidprogressPercentage = ($currentTotalAmountPaid - $lastWeekTotalAmountPaid) / $lastWeekTotalAmountPaid * 100;

        $unpaidCount = Payment::where('payment_status', 'unpaid')->count();
        $totalCustomersCount = Customer::count(); // Assuming you have a Customer model
        $unPaidPercentage = ($unpaidCount / $totalCustomersCount) * 100;


        $paidCount = Payment::where('payment_status', 'paid')->count();
        // $totalCustomersCount = Customer::count(); // Assuming you have a Customer model
        $paidPercentage = ($paidCount / $totalCustomersCount) * 100;

        $allOverdue = Payment::where(function ($query) {
            $query->where('payment_status', 'unpaid')->orWhere('payment_status', 'partially');
        })->where('purchase_date', '<=', Carbon::now()->subMonth())->get();

        $overdueCount = $allOverdue->count();
        // $totalCustomersCount = Customer::count(); // Assuming you have a Customer model

        $overDuePercentage = ($overdueCount / $totalCustomersCount) * 100;

        $partiallyCount = Payment::where('payment_status', 'partially')->latest()->get();
        $partiallyPaidCount = $partiallyCount->count();
        $partiallyPercentage = ($partiallyPaidCount / $totalCustomersCount) * 100;

        $totalCustomersCount = Customer::count();

        $allProduct = DB::table('products')->select('product_name', 'product_amount')->get();

        $unpaidCustomers = Payment::where('payment_status', 'unpaid')->latest()->limit(5)->get();
        $paidCustomers = Payment::where('payment_status', 'paid')->latest()->limit(5)->get();


        return view('admin.index',compact('customers','progressPercentage','weeklyProgressPercentage','currentTotalAmountPaid',
        'weeklyTotalAmountPaidprogressPercentage','unpaidCount','unPaidPercentage','paidCount','paidPercentage','overdueCount',
        'overDuePercentage','partiallyPaidCount','partiallyPercentage','totalCustomersCount','allProduct','unpaidCustomers','paidCustomers'));
    } // End Mehtod

    public function AdminLogin(){
        return view('admin.admin_login');
    } // End Mehtod

    public function AdminDestroy(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'success'
        );
        return redirect('/admin/login')->with($notification);

    } // End Mehtod

    public function AdminProfile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view',compact('adminData'));
    } // End Mehtod

    public function AdminProfileStore(Request $request){
        $validateData = $request->validate([
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'photo' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ],
        [
            'name.required' => 'Please Input name',
            'email.required' => 'Please Input email',
            'phone.required' => 'Please Input phone',
            'photo.min' => 'Image Longer Than 4 Characters',
        ]);
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->facebook = $request->facebook;
        $data->twitter = $request->twitter;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $image = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1000, 1000)->save('upload/admin_images/' . $name_gen);
            $last_img = 'upload/admin_images/' . $name_gen;
            $data['photo'] = $name_gen;
        }
        $data->save();
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Mehtod

    public function AdminChangePassword(){
        return view('admin.admin_change_password');
    } // End Mehtod

    public function AdminUpdatePassword(Request $request){
        $validateData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
                ],
                [
                    'old_password.required' => 'Please Input Old password',
                    // 'new_password_confirmation.required' => 'Please Input confirm password',
                ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {

        $notification = array(
            'message' => 'Wrong old password',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
        }
        // Update The new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'Password Successfully Changed',
            'alert-type' => 'success'
        );
        return redirect('/admin/login')->with($notification);
    } // End Mehtod

    public function allAdminView(){
        $roles = Role::where('status','0')->latest()->get();
        // $roles = Role::latest()->get();
        $allData = User::where('role','admin')->where('role_type', '0')->latest()->get();
        return view('backend.admin.index',compact('allData','roles'));
    } // End Method

    public function allAdminAdd(){
        $roles = Role::where('status','0')->latest()->get();
        return view('backend.admin.add_admin',compact('roles'));
    } // End Method


    public function allAdminstore(Request $request){
        $validatedData = $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'gender' => 'required',
        'address' => 'required',
        'password' => 'required',
        'roles' => 'required',
    ],
    [
        'name.required' => 'Please Input name',
        'phone.required' => 'Please Input phone',
        'email.required' => 'Please Input email',
        'gender.required' => 'Please Input gender',
        'address.required' => 'Please Input address',
        'password.required' => 'Please Input password',
        'roles.required' => 'Please Input roles',
    ]);

    $user = User::create([
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'gender' => $request->gender,
        'address' => $request->address,
        'password' => Hash::make($request->password),
        'role' => 'admin',
        'status' => 'active',
        'created_by' => Auth::user()->id,
        'created_at' => Carbon::now(),
    ]);

    if ($request->roles) {
        $user->assignRole($request->roles);
    }
    return redirect()->route('all.admin.view')->with([
            'message' => 'New Admin User Inserted Successfully',
            'alert-type' => 'success'
        ]);
    } //End Method

    public function allAdminEdit($id){
        $editData = User::findOrFail($id);
        $roles = Role::where('status','0')->latest()->get();
        return view('backend.admin.edit_admin',compact('editData','roles'));
    }// End Mehtod

    public function allAdminUpdate(Request $request, $id){
        $validatedData = $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'gender' => 'required',
        'address' => 'required',
        'roles' => 'required',
    ],
    [
        'name.required' => 'Please Input name',
        'phone.required' => 'Please Input phone',
        'email.required' => 'Please Input email',
        'gender.required' => 'Please Input gender',
        'address.required' => 'Please Input address',
        'roles.required' => 'Please Input roles',
    ]);
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'role' => 'admin',
            'status' => 'active',
        ]);
        $user->roles()->sync($request->roles ?? []);

        $notification = [
            'message' => 'Admin User Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.admin.view')->with($notification);
    }

    public function allAdminDelete($id){
        $user = User::find($id);
        if ($user) {
            $user->delete();

            $notification = [
                'message' => 'Admin User deleted successfully.',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.admin.view')->with($notification);
        }
        $notification = [
            'message' => 'User not found.',
            'alert-type' => 'danger',
        ];
            return redirect()->back()->with($notification);
    }

}
