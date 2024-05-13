<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


use Illuminate\Validation\ValidationException;
use Illuminate\Cache\RateLimiter;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function login(Request $request, RateLimiter $limiter)
    {
        try {

            $key = $request->ip(); // Get client ip

            $maxAttempts = 7; // Maximum login attempts allowed
            $lockoutTime = 5; // Lockout time in minutes after exceeding max attempts

            // Check if the user has exceeded the maximum login attempts
            if ($limiter->tooManyAttempts($key, $maxAttempts)) {
                $seconds = $limiter->availableIn($key);
                return back()->with(['alert' => true, 'message' => 'Too many login attempts. Please try again in '.$seconds.' seconds.']);
            }

            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            
            if (Auth::attempt($credentials)) {

                // Clear the login attempts if successful
                $limiter->clear($key);

                // Authentication successful
                return redirect()->route('productspages');
            } else {
                // Increment login attempts for the user
                $limiter->hit($key, $lockoutTime * 60); // Convert lockout time to seconds
                // Authentication failed
                return back()->with(['alert' => true, 'message' => 'Invalid email or password']);
            }
        } catch (ValidationException $e) {
            // Handle validation errors;
            $limiter->hit($key, $lockoutTime * 60);
            return back()->with(['alert' => true, 'message' => 'Please enter your email and password or invalid email or password format']);
        } 
    }

    public function register(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|',
            ]);
            
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
            ]);

            return redirect()->route('login');

        } catch (ValidationException $e) {
            return back()->with(['alert' => true, 'message' => 'Please enter your email and password or invalid email or password format']);
        }
    }

    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('login');
    }
}
