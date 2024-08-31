<?php

namespace App\Http\Controllers;

use App\Models\OtpToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    public function showTwoFactorForm()
    {
        return view('auth.two-factor');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);

        $otpToken = OtpToken::where('otp_token', $request->otp)
            ->where('expires_at', '>', now())
            ->where('user_id', Auth::id())
            ->first();

        if ($otpToken) {
            $otpToken->delete();
            return redirect()->intended('/');
        }

        return back()->withErrors(['otp' => 'Otp is invalid']);
    }
}
