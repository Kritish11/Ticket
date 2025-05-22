<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        // Generate 6 digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => Hash::make($validated['password']),
                'otp' => $otp,
                'otp_expires_at' => now()->addMinutes(10)
            ]);

            // Send OTP email using try-catch
            try {
                Mail::send('emails.otp', ['otp' => $otp], function($message) use ($user) {
                    $message->to($user->email)
                           ->subject('Email Verification OTP');
                });
            } catch (\Exception $e) {
                // Log mail error
                \Log::error('OTP Email Error: ' . $e->getMessage());
                return back()->with('error', 'Failed to send OTP email. Please try again.');
            }

            Session::put('user_id', $user->id);
            return redirect()->route('email.verify')
                           ->with('success', 'Registration successful! Please verify your email.');
        } catch (\Exception $e) {
            \Log::error('Registration Error: ' . $e->getMessage());
            return back()->with('error', 'Registration failed. Please try again.');
        }
    }

    public function verifyOtp(Request $request)
    {
        $userId = Session::get('user_id');
        if (!$userId) {
            return redirect()->route('register')
                            ->with('error', 'Session expired. Please register again.');
        }

        try {
            $user = User::findOrFail($userId);

            // Validate the combined OTP
            $request->validate([
                'otp' => 'required|string|size:6'
            ]);

            $submittedOtp = $request->input('otp');

            // Check if OTP matches
            if ($user->otp !== $submittedOtp) {
                return back()->with('error', 'Invalid OTP. Please try again.');
            }

            // Check if OTP is expired
            if ($user->otp_expires_at < now()) {
                return back()->with('error', 'OTP has expired. Please request a new one.');
            }

            // Verify user
            $user->email_verified = true;
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            // Clear session
            Session::forget('user_id');

            return redirect()->route('login')
                            ->with('success', 'Email verified successfully! You can now login.');

        } catch (\Exception $e) {
            \Log::error('OTP Verification Error: ' . $e->getMessage());
            return back()->with('error', 'Verification failed. Please try again.');
        }
    }

    public function resendOtp()
    {
        $userId = Session::get('user_id');
        if (!$userId) {
            return redirect()->route('register')
                           ->with('error', 'Session expired. Please register again.');
        }

        $user = User::findOrFail($userId);

        // Generate new OTP
        $newOtp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        try {
            // Update user with new OTP
            $user->update([
                'otp' => $newOtp,
                'otp_expires_at' => now()->addMinutes(10)
            ]);

            // Send new OTP email
            Mail::send('emails.otp', ['otp' => $newOtp], function($message) use ($user) {
                $message->to($user->email)
                       ->subject('New Email Verification OTP');
            });

            return back()->with('success', 'New OTP has been sent to your email.');
        } catch (\Exception $e) {
            \Log::error('Resend OTP Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to resend OTP. Please try again.');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $credentials['email'])
                    ->where('email_verified', true)
                    ->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Store user info in session
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'is_logged_in' => true
            ]);

            return redirect()->intended('/')
                ->with('success', 'Welcome back, ' . $user->name);
        }

        return back()
            ->withErrors(['email' => 'Invalid credentials'])
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        session()->forget([
            'user_id',
            'user_name',
            'user_email',
            'is_logged_in'
        ]);

        return redirect('/')->with('success', 'Logged out successfully');
    }
}
