<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectBasedOnUserType($request->user());
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
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
                return redirect()->route('admin.dashboard');
            case 'client':
                return redirect()->route('client.dashboard');
            case 'staff':
                return redirect()->route('staff.dashboard');
            case 'ophthal':
                return redirect()->route('ophthal.dashboard');
            default:
                return redirect()->route('landing');
        }
    }
}
