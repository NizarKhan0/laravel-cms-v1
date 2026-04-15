<?php

namespace App\Http\Controllers\backendUser\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;

class EmailVerificationController extends Controller
{
    public function notice()
    {
        return view('backend-user.auth.verify-email');
    }

    public function verify(Request $request, $id, $hash)
    {
        $user = $request->user('admin'); // IMPORTANT

        if (!$user) {
            abort(403, 'Not logged in');
        }

        if (! hash_equals((string) $id, (string) $user->getKey())) {
            abort(403);
        }

        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('admin.dashboard');
        }

        $user->markEmailAsVerified(); // 🔥 THIS IS THE KEY

        event(new Verified($user));

        return redirect()->route('admin.dashboard')
            ->with('success', 'Email verified successfully');
    }

    public function resend(Request $request)
    {
        $user = $request->user('admin');

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('admin.dashboard');
        }

        $user->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}