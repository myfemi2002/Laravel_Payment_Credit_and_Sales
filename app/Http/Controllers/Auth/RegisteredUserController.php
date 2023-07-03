<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */


// public function store(Request $request)
// {
//     $request->validate([
//         'name' => ['required', 'string', 'max:255'],
//         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//         'password' => ['required', 'confirmed', Rules\Password::defaults()],
//         'username' => ['required', 'string', 'max:255'],
//         'country_code' => ['required'],
//         'phone_number' => ['required'],
//         'gender' => ['required'],
//         'date_of_birth' => ['required', 'date'],
//         'address' => ['required', 'string'],
//         'country' => ['required', 'string'],
//         'city' => ['required', 'string'],
//         'referral_code' => ['nullable', 'string', 'max:255'],
//     ]);

//     // Generate a unique referral code
//     $referralCode = $this->generateReferralCode($request->name);

//     $user = User::create([
//         'name' => $request->name,
//         'email' => $request->email,
//         'username' => $request->username,
//         'password' => Hash::make($request->password),
//         'country_code' => $request->country_code,
//         'phone_number' => $request->phone_number,
//         'gender' => $request->gender,
//         // 'date_of_birth' => \Carbon\Carbon::createFromFormat('d/M/Y', $request->date_of_birth)->format('Y-m-d'),
//         'date_of_birth' => \Carbon\Carbon::createFromFormat('m/d/Y', $request->date_of_birth)->format('Y-m-d'),

//         'address' => $request->address,
//         'country' => $request->country,
//         'city' => $request->city,
//         'referral_code' => $referralCode,
//     ]);

//     // Check if a referral code was provided
//     if ($request->referral_code) {
//         // Find the referring user by referral code
//         $referringUser = User::where('referral_code', $request->referral_code)->first();

//         // if ($referringUser && $referringUser->id !== $user->id) {
//         //     // Create the referral relationship
//         //     $user->referrals()->create([
//         //         'referred_by' => $referringUser->id,
//         //     ]);

//         //     $referringUser->referrals()->increment('referral_count');
//         // } else {

//             if ($referringUser && $referringUser->id !== $user->id) {
//                 // Create the referral relationship
//                 $user->referrals()->create([
//                     'referred_by' => $referringUser->id,
//                 ]);

//                 // Increment the referral count for the referring user
//                 $referringUser->referrals()->increment('referral_count');
//             } else {

//             // Handle invalid referral code error
//             $notification = [
//                 'message' => 'Invalid referral code.',
//                 'alert-type' => 'error'
//             ];
//             return redirect()->back()->with($notification);
//         }
//     }

//     // Redirect or perform any other logic after successful registration
//     $notification = [
//         'message' => 'Registered Successfully',
//         'alert-type' => 'success'
//     ];
//     return redirect('login')->with($notification);
// }



public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'username' => ['required', 'string', 'max:255'],
        'country_code' => ['required'],
        'phone_number' => ['required'],
        'gender' => ['required'],
        'date_of_birth' => ['required', 'date'],
        'address' => ['required', 'string'],
        'country' => ['required', 'string'],
        'city' => ['required', 'string'],
        'referral_code' => ['nullable', 'string', 'max:255'],
    ]);

    // Generate a unique referral code
    $referralCode = $this->generateReferralCode($request->name);

    $dateOfBirth = \Carbon\Carbon::parse($request->date_of_birth);
    $age = $dateOfBirth->diffInYears(\Carbon\Carbon::now());

    if ($age < 18) {
        // Handle underage user error
        $notification = [
            'message' => 'You must be at least 18 years old to register.',
            'alert-type' => 'error'
        ];
        return redirect()->back()->with($notification);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'country_code' => $request->country_code,
        'phone_number' => $request->phone_number,
        'gender' => $request->gender,
        'date_of_birth' => $dateOfBirth->format('Y-m-d'),
        'address' => $request->address,
        'country' => $request->country,
        'city' => $request->city,
        'referral_code' => $referralCode,
    ]);

    // Check if a referral code was provided
    if ($request->referral_code) {
        // Find the referring user by referral code
        $referringUser = User::where('referral_code', $request->referral_code)->first();

        if ($referringUser && $referringUser->id !== $user->id) {
            // Create the referral relationship
            $user->referrals()->create([
                'referred_by' => $referringUser->id,
            ]);

            $referringUser->referrals()->increment('referral_count');
        } else {
            // Handle invalid referral code error
            $notification = [
                'message' => 'Invalid referral code.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }

    // Redirect or perform any other logic after successful registration
    $notification = [
        'message' => 'Registered Successfully',
        'alert-type' => 'success'
    ];
    return redirect('login')->with($notification);
}


private function generateReferralCode($userName)
{
    // Generate a unique referral code based on the user's name
    $referralCode = strtolower(str_replace(' ', '', $userName));

    // Check if the generated referral code already exists in the database
    $existingReferralCode = User::where('referral_code', $referralCode)->exists();

    // If the referral code exists, generate a new one until a unique code is found
    while ($existingReferralCode) {
        $referralCode = strtolower(str_replace(' ', '', $userName)) . uniqid();
        $existingReferralCode = User::where('referral_code', $referralCode)->exists();
    }

    return $referralCode;
}







}

