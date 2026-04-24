<?php

namespace App\Http\Controllers\frontendUser\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function notice()
    {
        return view('frontend-user.auth.verify-email');
    }

    public function verify(Request $request, $id, $hash)
    {
        $user = $request->user('user');

        if (!$user) {
            abort(403, 'Not logged in');
        }

        if (!hash_equals((string) $id, (string) $user->getKey())) {
            abort(403);
        }

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('user.dashboard');
        }

        $user->markEmailAsVerified();
        event(new Verified($user));

        return redirect()->route('user.dashboard')
            ->with('success', 'Email verified successfully');
    }

    public function resend(Request $request)
    {
        $user = $request->user('user');

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('user.dashboard');
        }

        $user->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
