<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Cache\RateLimiter;
// use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Carbon\Carbon;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */



     public function store(Request $request, RateLimiter $limiter)
     {
         $request->validate([
             'email' => ['required', 'email'],
             'password' => ['required'],
         ]);

         $credentials = $request->only('email', 'password');

         if (Auth::attempt($credentials)) {
             $request->session()->regenerate();

             $notification = [
                 'message' => 'Login Successful',
                 'alert-type' => 'success'
             ];

             // Redirect users based on their role
             $user = Auth::user();
             $url = '';

             if ($user->role === 'admin') {
                 $url = 'admin/dashboard';
             } elseif ($user->role === 'customer') {
                 $url = '/customers/dashboard';
             } elseif ($user->role === 'user') {
                 $url = '/user/dashboard';
             }

             return redirect()->intended($url)->with($notification);
         }

         if ($limiter->tooManyAttempts($this->getRateLimiterKey($request), 3)) {
             $retryAfter = $limiter->availableIn($this->getRateLimiterKey($request));

             $notification = [
                 'message' => 'Too many login attempts. Please try again in ' . $retryAfter . ' seconds.',
                 'alert-type' => 'error',
                 'remainingSeconds' => $retryAfter
             ];

             return redirect()
                 ->back()
                 ->withInput($request->only('email'))
                 ->withErrors($notification)
                 ->with('disableSubmitButton', true);
         }

         $limiter->hit($this->getRateLimiterKey($request));

         $notification = [
             'message' => 'Wrong email or password',
             'alert-type' => 'error'
         ];

         return redirect()
             ->back()
             ->withInput($request->only('email'))
             ->withErrors($notification);
     }

     protected function getRateLimiterKey(Request $request)
     {
         return Str::lower($request->input('email')) . '|' . $request->ip();
     }





































    //  public function store(Request $request, RateLimiter $limiter)
    //  {
    //      $request->validate([
    //          'email' => ['required', 'email'],
    //          'password' => ['required'],
    //      ]);

    //      if ($limiter->tooManyAttempts($this->getRateLimiterKey($request), 3)) {
    //          $this->handleTooManyAttempts();
    //      }

    //      $credentials = $request->only('email', 'password');

    //      if (Auth::attempt($credentials)) {
    //          $request->session()->regenerate();

    //          $notification = [
    //              'message' => 'Login Successful',
    //              'alert-type' => 'success'
    //          ];

    //          // Redirect users based on their role
    //          $user = Auth::user();
    //          $url = '';

    //          if ($user->role === 'admin') {
    //              $url = 'admin/dashboard';
    //          } elseif ($user->role === 'customer') {
    //              $url = '/customers/dashboard';
    //          } elseif ($user->role === 'user') {
    //              $url = '/user/dashboard';
    //          }

    //          $limiter->clear($this->getRateLimiterKey($request)); // Clear login attempts upon successful login

    //          return redirect()->intended($url)->with($notification);
    //      }

    //      $limiter->hit($this->getRateLimiterKey($request));

    //      $notification = [
    //          'message' => __('auth.failed'),
    //          'alert-type' => 'error'
    //      ];

    //      return redirect()->back()->withInput($request->only('email'))->withErrors($notification)->with('minutes', 10);
    //  }

    //  protected function handleTooManyAttempts()
    //  {
    //      // Handle too many attempts error
    //      $notification = [
    //          'message' => 'Too many login attempts. Please try again later.',
    //          'alert-type' => 'error',
    //          'minutes' => 10
    //      ];

    //      $retryAfter = Carbon::now()->addMinutes($notification['minutes']);

    //      throw ValidationException::withMessages([
    //          'email' => __('auth.throttle', [
    //              'seconds' => $retryAfter->diffInSeconds(Carbon::now()),
    //              'minutes' => $notification['minutes'],
    //          ])
    //      ])->status(429);
    //  }

    //  protected function getRateLimiterKey(Request $request)
    //  {
    //      return Str::lower($request->input('email')) . '|' . $request->ip();
    //  }





    //  public function store(Request $request, RateLimiter $limiter)
    //  {
    //      $request->validate([
    //          'email' => ['required', 'email'],
    //          'password' => ['required'],
    //      ]);

    //      if ($limiter->tooManyAttempts($this->getRateLimiterKey($request), 3)) {
    //          $this->handleTooManyAttempts();
    //      }

    //      $credentials = $request->only('email', 'password');

    //      if (Auth::attempt($credentials)) {
    //          $request->session()->regenerate();

    //          $notification = [
    //              'message' => 'Login Successful',
    //              'alert-type' => 'success'
    //          ];

    //          // Redirect users based on their role
    //          $user = Auth::user();
    //          $url = '';

    //          if ($user->role === 'admin') {
    //              $url = 'admin/dashboard';
    //          } elseif ($user->role === 'customer') {
    //              $url = '/customers/dashboard';
    //          } elseif ($user->role === 'user') {
    //              $url = '/user/dashboard';
    //          }

    //          $limiter->clear($this->getRateLimiterKey($request)); // Clear login attempts upon successful login

    //          return redirect()->intended($url)->with($notification);
    //      }

    //      $limiter->hit($this->getRateLimiterKey($request));

    //      $notification = [
    //          'message' => __('auth.failed'),
    //          'alert-type' => 'error'
    //      ];

    //      return redirect()->back()->withInput($request->only('email'))->with($notification);
    //  }

    //  protected function handleTooManyAttempts()
    //  {
    //      // Handle too many attempts error
    //      $notification = [
    //          'message' => 'Too many login attempts. Please try again later.',
    //          'alert-type' => 'error'
    //      ];

    //      throw ValidationException::withMessages([
    //          'email' => __('auth.throttle', [
    //              'seconds' => config('auth.throttle.seconds'),
    //              'minutes' => ceil(config('auth.throttle.seconds') / 3600),
    //          ])
    //      ]);
    //      $notification = [
    //         'message' => 'Too many login attempts. Please try again later.',
    //          'alert-type' => 'error'
    //     ];

    //  }

    //  protected function getRateLimiterKey(Request $request)
    //  {
    //      return Str::lower($request->input('email')) . '|' . $request->ip();
    //  }








    // public function store(LoginRequest $request)
    // {
    //     $request->authenticate();
    //     $request->session()->regenerate();
    //     $notification = array(
    //         'message' => 'Login Successfully',
    //         'alert-type' => 'success'
    //     );
    //     $url = '';
    //     if ($request->user()->role === 'admin') {
    //         $url = 'admin/dashboard';
    //     }

    //     elseif ($request->user()->role === 'customer') {
    //         $url = '/customers/dashboard';
    //     }

    //     elseif ($request->user()->role === 'user') {
    //         $url = '/user/dashboard';
    //     }
    //     return redirect()->intended($url)->with($notification);
    // }











    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
