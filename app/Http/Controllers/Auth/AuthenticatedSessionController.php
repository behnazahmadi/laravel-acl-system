<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\OtpToken;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
//    public function store(LoginRequest $request): RedirectResponse
//    {
//        $request->authenticate();
//
//        $request->session()->regenerate();
//
//        return redirect()->intended(RouteServiceProvider::HOME);
//    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'otp' => 'nullable|numeric',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->two_factor_enabled) {
                $otp = rand(100000, 999999);
                OtpToken::create([
                    'user_id' => $user->id,
                    'otp_token' => $otp,
                    'expires_at' => now()->addMinutes(10),
                ]);
//                Mail::to($user->email)->send(new \App\Mail\SendOtpEmail($otp));
                return redirect()->route('auth.two_factor');
            }
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
