<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectBasedOnUserType($request->user());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->redirectBasedOnUserType($request->user());
    }

    /**
     * Redirect user to their respective dashboard based on user type.
     *
     * @param  \App\Models\User  $user
     * @return RedirectResponse
     */
    protected function redirectBasedOnUserType($user): RedirectResponse
    {
        switch ($user->usertype) {
            case 'admin':
                return redirect()->route('admin.dashboard')->with('verified', 1);
            case 'client':
                return redirect()->route('client.dashboard')->with('verified', 1);
            case 'staff':
                return redirect()->route('staff.dashboard')->with('verified', 1);
            case 'ophthal':
                return redirect()->route('ophthal.dashboard')->with('verified', 1);
            default:
                return redirect()->route('landing')->with('verified', 1);
        }
    }
}
